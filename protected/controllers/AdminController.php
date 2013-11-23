<?php

class AdminController extends Controller
{
    
    public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				//'actions'=>array('index','viewMeeting',''),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    
	public function actionIndex()
	{
		    $criteria=new CDbCriteria(); 
            $criteria->compare('checkinstatus', Meeting::CHECKIN_OPEN);
            $openmeetings = Meeting::model()->findAll($criteria);
            
            $criteria=new CDbCriteria(); 
            $criteria->compare('checkinstatus', Meeting::CHECKIN_CLOSED);
            $closedmeetings = Meeting::model()->findAll($criteria);
            
		$this->render('index', array(
                    'openmeetings' => $openmeetings,
                    'closedmeetings' => $closedmeetings,
                ));
	}
        
        /**
         * Notify the numbers about this meeting
         * Expects: $_POST values of: "meetingid" and "numbers" (array via checkboxes)
         * @throws Exception
         */
        public function actionNotify()
        {
            $id = $_POST['meetingid']; //meetingid of the meeting to notify.
            
            if(!isset($id))
                throw new Exception("I don't know what you mean: the meetingid is missing.");
        
            $meeting=Meeting::model()->findByPk($id);
            
            if(!$meeting)
                throw new Exception("I don't know what you mean: invalid meeting id.");
            
            $numbers = array_keys($_POST['numbers']);
            $meeting->notify($numbers);
            
            return $this->redirect(array('admin/viewMeeting', 'id' => $id));
                   
        }
        
        public function actionViewMeeting( $id )
        {
            //look up meeting
            $model=Meeting::model()->findByPk($id);
            
            if($model == null)
                throw new Exception("Model not found");
            
            if(isset($_POST['User']))
            {
                $this->saveNewUser($model);
                return $this->redirect(array('admin/viewMeeting', 'id' => $id));
            }
            Yii::log("rendering viewMeeting for meeting: ".$id);
            $this->render('viewMeeting', array(
                'meeting' => $model,
            ));
        }
        
        public function saveNewUser($meeting)
        {
            $model = new User();
            
            if(isset($_POST['User'])) //they are saving the newUser form
            {
                $model->attributes=$_POST['User'];
                if($model->save())
                {
                    //now record them as an attendee to the meeting id
                    $attendee = $meeting->saveAttendee($model->id, AttendeeType::PARTICIPANT);
                }
            }
        }
        
        public function actionToggleMeetingStatus( $id )
        {
            $model=Meeting::model()->findByPk($id);
            
            if($model == null)
                throw new Exception("Model not found");
            
            ($model->checkinstatus == Meeting::CHECKIN_CLOSED) ? $model->checkinstatus = Meeting::CHECKIN_OPEN : $model->checkinstatus = Meeting::CHECKIN_CLOSED;
            //$model->checkinstatus = 0;
            $model->save();
            
            if($model->checkinstatus == Meeting::CHECKIN_CLOSED)
                echo "<div class='error'>Checkins are closed</div>";
            
            echo CHtml::ajaxButton(
                ($model->checkinstatus == Meeting::CHECKIN_OPEN) ? 'Close Checkins' : 'Open Checkins' ,
                array('admin/toggleMeetingStatus', 'id' => $model->id), 
                array('update' => '#toggle-status', 'class'),
                array('class' => 'button radius')
            ); 
            
            return;
            
        }
        
        public function actionCheckinExistingUser()
        {
             //look up meeting
            $model=Meeting::model()->findByPk($_POST['meetingid']);
            
            if($model == null)
                throw new Exception("Model not found");
            
            if(isset($_POST['user-lookup']))
            {
                $this->actionToggleAttendeeStatus($_POST['meetingid'], $_POST['user-lookup'], false);
            }
            
            return $this->redirect(array('admin/viewMeeting', 'id' => $model->id));
            
        }
        
        public function actionToggleAttendeeStatus($id, $userid, $ajax = true)
        {
            $meeting=Meeting::model()->findByPk($id);
            
            if($meeting == null)
                throw new Exception("Meeting not found");
            
            if($meeting->checkinstatus == Meeting::CHECKIN_CLOSED)
                throw new Exception('Error: you cannot checkin to a closed meeting.');
            
            //are they a leader or a participant?
            if(Meeting::getUserFromUsers($userid, $meeting->event->leaders))
            {
                if(is_null(Meeting::getUserFrom($userid, $meeting->leaders)))
                {
                    $meeting->saveAttendee($userid, AttendeeType::LEADER);
                }
                else
                {
                    $meeting->removeAttendee($userid, AttendeeType::LEADER);
                }
            }
            else
            {
                if(is_null(Meeting::getUserFrom($userid, $meeting->participants)))
                    $meeting->saveAttendee($userid, AttendeeType::PARTICIPANT);
                else
                    $meeting->removeAttendee($userid, AttendeeType::PARTICIPANT);

            }
            
            
            $meeting=Meeting::model()->findByPk($id);

            if($ajax)
            {

                echo $this->renderPartial('_checkinList', 
                    array('meeting' => $meeting, 
                          'attendee_list'=>$meeting->getRecentLeaders(),
                          'current_list' => $meeting->leaders)
                    ); 

                echo $this->renderPartial('_checkinList',
                        array('meeting' => $meeting, 
                            'attendee_list' => $meeting->getRecentParticipants(),
                            'current_list' => $meeting->participants)
                    );
            }
            
            return;
            
        }
        
        public function actionSearchUser()
        {
            $model        = new User();
            $model->firstname = $_GET['q'];
            //$model->lastname  = $_GET['q'];
            
            $result       = array();
            foreach ($model->search()->getData() AS $data) {
                $result[] = array(
                    'id'    => $data->id,
                    'firstname' => $data->firstname,
                    'lastname'  => $data->lastname
                );
            }
            echo $_GET['callback'] . "(";
            echo CJSON::encode($result);
            echo ")";
        }
        
        public function actionStartEvent( $id )
        {
            //look up event -- this is the "kind" of meeting we are going to have
            $model=Event::model()->findByPk($id);
            
            if($model == null)
                throw new Exception("Model not found");
            
            $meeting = new Meeting(); //startup our new meeting
            
            //are we saving?  If so then save and return viewEvent
            if(isset($_POST['Meeting']))
            {
                    $meeting->attributes=$_POST['Meeting'];                    
                    
                    $meeting->id = null;
                    if($meeting->save())
                    {
                        //add the saving user as the leader attendee
                        $meeting->saveAttendee($this->getCurrentUserId(), AttendeeType::LEADER);
                        $this->redirect(array('viewMeeting','id'=>$meeting->id));
                    }
                    
            }

            //ok well then lets populate some defaults.
            $meeting->eventid = $model->id;
            $meeting->title = $model->name;
            $meeting->description = $model->description;
            $meeting->starttime = $model->starttime;
            $meeting->endtime = $model->endtime;
            $meeting->checkinstatus = Meeting::CHECKIN_OPEN;
            
            //pretty lame-o way to get a time array, but oh well.
            $timearray = array();
            $earliest = 5;
            $latest = 11;
            for($hour=$earliest; $hour <= $latest; $hour ++) {
                $timearray[$hour . ":00am"] = $hour . ":00am";
            }
            $timearray['12:00pm'] = '12:00pm';
            $earliest = 1;
            $latest = 11;
            for($hour=$earliest; $hour <= $latest; $hour ++) {
                $timearray[$hour . ":00pm"] = $hour . ":00pm";
            }
            $timearray['12:00am'] = '12:00am';
            
            
            $this->render('startEvent',array(
			'model'=>$model,
                        'meeting'=>$meeting,
                        'timearray'=>$timearray,
		));
        }
        
        private function getCurrentUserId()
        {
            return Yii::app()->user->id;
        }

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
<?php

class ReportController extends Controller
{

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionAttendance($type = AttendeeType::PARTICIPANT)
	{
 /*           
              $criteria=new CDbCriteria;
                $criteria->select = 'sum(views), userName';
                $criteria->with = 'user';
                $criteria->order='views DESC';
                $criteria->group = 'user.userId';
                $criteria->limit=5;
                $dataProvider=new CActiveDataProvider('Rant', array(
                        'criteria'=>$criteria,
                ));  
   
  * select User.firstname, User.lastname, User.firstcontact, count(Attendee.typeid) as num_meetings
     from       user as User
LEFT JOIN attendee as Attendee ON Attendee.userid = User.id 
where Attendee.typeid = 2
group by            User.id
order by           User.lastname ASC
  * 
  * 
  */         
            
            $sql = 'select User.id, User.firstname, User.lastname, User.firstcontact, count(Attendee.typeid) as num_meetings
     from       user as User
LEFT JOIN attendee as Attendee ON Attendee.userid = User.id 
where Attendee.typeid = '.$type.'
group by            User.id
order by           User.lastname ASC';
                    
$cmd = Yii::app()->db->createCommand($sql);
$dataprovider = $cmd->queryAll();

            /*
            $criteria = new CDbCriteria(); 
            $criteria->select = 'User.firstname, User.lastname, User.firstcontact, count(Attendee.typeid) as num_meetings';
            $criteria->with='User';
            $criteria->join = 'LEFT JOIN Attendee ON Attendee.userid = User.id ';
            $criteria->condition = 'Attendee.typeid = '.$attendee_type ;
            $criteria->group = 'User.id';
            $criteria->order = 'User.lastname ASC';
            
            $dataProvider=new CActiveDataProvider('User', array(
                        'criteria'=>$criteria,
            ));             
             * 
             */
            
            $this->render('attendance', array(
                'dataprovider' => $dataprovider,
                'url' => Yii::app()->params['base'] . '/report/attendance',
                'baseUrl' => Yii::app()->params['base'],
                'type' => $type
              ));
	}
        
        //1 = all, 2 = SLP only
	public function actionMeetings($type = 1)
        {
            $meetings = Meeting::model()->findAll();
            
            $this->render('meetings', array(
                'meetings' => $meetings,
                'type' => $type,
                'url' => Yii::app()->params['base'] . '/report/meetings',
                'baseUrl' => Yii::app()->params['base'],
            ));
        }

        public function actionRosters()
        {
            $events = Event::model()->findAll();

            
            $this->render('rosters', array(
                'events' => $events,
            ));
        }
        
}
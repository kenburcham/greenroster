<?php

class CheckinController extends Controller
{
        public $layout = '//layouts/spartan';

        //gives us our checkin page
	public function actionIndex($id = 0, $userid = 0)
	{
            $meeting = Meeting::model()->findByPk($id);

            if(!$meeting)
                return $this->render('needMeetingId');
            
            if($meeting->checkinstatus == Meeting::CHECKIN_CLOSED)
                return $this->render('closedCheckin');
            
            if($meeting && $userid)
            {
                $user = User::model()->findByPk($userid);
                
                $attendee = $meeting->saveAttendee($user->id, AttendeeType::PARTICIPANT);
                return $this->redirect(array('checkin/done', 'id' => $attendee->meetingid));
            }
            
            $phone = $_POST['phone'];
            if(isset($phone))
            {
                $user = User::model()->findByAttributes(array('phone'=>$phone));
                if(!$user)
                {
                    return $this->redirect(array('checkin/newUser', 'id' => $meeting->id, 'phone' => $phone));
                }

                $attendee = $meeting->saveAttendee($user->id, AttendeeType::PARTICIPANT);
                return $this->redirect(array('checkin/done', 'id' => $attendee->meetingid));
            }
            
            $this->render('index', array('meeting' => $meeting));
	}
      
        //just displays the page when the user has checked in
        // id = attendeeid
        public function actionDone()
        {
            $id = $_GET['id'];
            
            if(!$id)
                throw new Exception("Sorry, I don't know what you mean.");
            
            $attendee = Attendee::model()->findByAttributes(array('meetingid' => $id));
            
            if(!$attendee)
                throw new Exception("Sorry, I don't know what you mean.");
            
            return $this->render('checkedin', array('attendee' => $attendee));
        }
        
        /**
         * Create a new user
         * @param type $id
         * @param type $phone
         * @return type
         */
        public function actionNewUser( $id, $phone = '' )
        {
            $meeting = Meeting::model()->findByPk($id);
            
            if(!$meeting)
                return $this->render('needMeetingId');
            
            $model = new User();
            
            if(isset($_POST['User'])) //they are saving the newUser form
            {
                $model->attributes=$_POST['User'];
                if($model->save())
                {
                    //now record them as an attendee to the meeting id
                    $attendee = $meeting->saveAttendee($model->id, AttendeeType::PARTICIPANT);
                    return $this->render('checkedin', array('attendee' => $attendee));
                }
            }
            
            if($phone != '')
                $model->phone = $phone;
            
            return $this->render('newuser', array('model' => $model, 'id' => $meeting->id));
            
        }
        
        
        
        
}
?>

<?php

/**
 * This is the model class for table "meeting".
 *
 * The followings are the available columns in table 'meeting':
 * @property integer $id
 * @property integer $eventid
 * @property string $createdate
 * @property string $eventdate
 * @property string $title
 * @property string $description
 * @property integer $numhours
 * @property integer $locationid
 * @property string $endingdatetime
 * @property integer $createdbyid
 * @property integer $checkinstatus
 * @property string $starttime
 * @property string $endtime
 * @property string $notes
 */
class Meeting extends CActiveRecord
{
        const CHECKIN_CLOSED = 0;
        const CHECKIN_OPEN = 1;
        
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Meeting the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'meeting';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('createdate, eventdate, starttime, endtime, numhours, title, description, locationid, createdbyid', 'required'),
			array('eventid, locationid, createdbyid, checkinstatus, numhours', 'numerical', 'integerOnly'=>true),
			array('title, notes', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, eventid, createdate, startdatetime, title, description, locationid, createdbyid, checkinstatus, notes', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                   'location' => array(self::BELONGS_TO,    'EventLocation', 'locationid'),
                   'event' => array(self::BELONGS_TO, 'Event', 'eventid'), 
                   'attendees' => array(self::HAS_MANY, 'Attendee','meetingid'),
                   'leaders' => array(self::HAS_MANY, 'Attendee','meetingid',
                       'on' => 'typeid='.AttendeeType::LEADER),
                    'participants' => array(self::HAS_MANY, 'Attendee','meetingid',
                       'on' => 'typeid='.AttendeeType::PARTICIPANT),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'eventid' => 'Eventid',
			'createdate' => 'Create Date',
			'eventdate' => 'Event Date',
			'title' => 'Title',
                        'numhours' => 'Number of Hours',
			'description' => 'Description',
			'locationid' => 'Location',
			'createdbyid' => 'Created By',
			'checkinstatus' => 'Checkin Open',
                        'starttime' => 'Start Time',
                        'endtime' => 'End Time',
			'notes' => 'Notes/Topic',
		);
	}

        //get participants that have attended this meeting in the recent past
        public function getRecentParticipants()
        {
            return $this->getRecentAttendeesOfType(AttendeeType::PARTICIPANT);
        }
        
        //get leaders for this event type
        public function getEventLeaders()
        {
            return $this->event->leaders();
        
        }
        
        //get leaders that have attended this meeting in the recent past
        public function getRecentLeaders()
        {
            //get leaders assigned to this event (they can checkin)
            $leaders = $this->getEventLeaders();
            //add in any leaders who are already checked in (maybe this is a past event)
            foreach ($this->leaders as $leader_attendee)
            {
                $la_userid = $leader_attendee->user->id;
                if(is_null($this->getUserFromUsers($la_userid, $leaders)))
                    $leader[] = $leader_attendee->user;    
            }
            
            return $leaders;
        }
        
        //get attendees of the given type that have attended this meeting in the recent past
        public function getRecentAttendeesOfType( $attendee_type)
        {
            $criteria = new CDbCriteria(); 
            $criteria->alias = 'participant';
            $criteria->join = 'LEFT JOIN meeting ON meeting.id = participant.meetingid LEFT JOIN user ON user.id = participant.userid';
            $criteria->condition = 'meeting.eventid='. $this->eventid.' AND participant.typeid = '.$attendee_type ;
            $criteria->group = 'userid';
            $criteria->order = 'user.lastname ASC';
            
            $participants=Attendee::model()->findAll($criteria);
            
            //throw new Exception(print_r($participants, true));
            
            return $participants;
        }
        
        
        
        public static function getUserIdsFrom($attendees)
        {
            $userids = array();
            foreach ($attendees as $p)
            {
                $userids[] = $p->userid;
            }
            return $userids;
        }
        
        //find a userid in an array of attendees
        public static function getUserFrom($userid, $attendees)
        {
            foreach($attendees as $a)
            {
                if($a->userid == $userid)
                {
                    return $a;
                }
            }
            
            return null;
                
        }
        
        //find a userid in an array of users
        public static function getUserFromUsers($userid, $users)
        {
            foreach($users as $a)
            {
                if($a->id == $userid)
                {
                    return $a;
                }
            }
            
            return null;
                
        }
        
        public function getLeadersAsString()
        {
            $leaders = array();
            foreach($this->leaders as $leader)
            {
                $leaders[] = $leader->user->firstname . " " . $leader->user->lastname;
            }
         
            return implode(",<br/>", $leaders);
        }
        
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('eventid',$this->eventid);
		$criteria->compare('createdate',$this->createdate,true);
		$criteria->compare('startdatetime',$this->startdatetime,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('locationid',$this->locationid);
		$criteria->compare('endingdatetime',$this->endingdatetime,true);
		$criteria->compare('createdbyid',$this->createdbyid);
		$criteria->compare('checkinstatus',$this->checkinstatus);
		$criteria->compare('notes',$this->notes,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function removeAttendee($userid, $typeid = null)
        {
            $criteria = new CDbCriteria();
            $criteria->compare('meetingid',$this->id);
            if(!is_null($typeid))
                $criteria->compare('typeid', $typeid);
            $criteria->compare('userid', $userid);
            
            Attendee::model()->deleteAll($criteria);
            
        }
        
        //saves an attendee(User) for this meeting and returns the attendee object.
        public function saveAttendee($userid, $typeid)
        {
            $existing = Attendee::model()->findByAttributes(
                    array(
                        'meetingid' => $this->id, 
                        'userid' => $userid,
                        ));
            
            if(!$existing)
            {
                $attendee = new Attendee();
                $attendee->meetingid = $this->id;
                $attendee->userid = $userid;
                $attendee->typeid = $typeid;
                $attendee->save();
            }
            else {
                $attendee = $existing;
            }
            
            return $attendee;
        }
        
        /**
         * Notify the given array of numbers about our meeting
         * @param type $numbers
         */
        public function notify($numbers)
        {
            if(empty($numbers))
                return;
            
            $message = "Reminder: ".$this->title. ' at '.$this->starttime.'. Check-in: ';
            
            $sender = new TxtSender();
            
            foreach($numbers as $number)
            {
                $user = User::getByPhone($number);
                
                if(!$user)
                    throw new Exception("Did not find user with phone: ". $number);
                
                $message .= Yii::app()->createAbsoluteUrl('checkin',array('id'=>$this->id, 'userid' => $user->id));
                
                $sender->send($number, $message);
            }
            
            
        }
        
        public function beforeValidate()
        {
            if(parent::beforeValidate())
            {
                if($this->isNewRecord)
                {
                    $this->createdate = new CDbExpression('now()');
                    $this->createdbyid = 1; //set to current user
                }
                
                $this->eventdate = date('Y-m-d', strtotime($this->eventdate));
                
                return true;
            }
            
        }
}
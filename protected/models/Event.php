<?php

/**
 * This is the model class for table "event".
 *
 * The followings are the available columns in table 'event':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $starttime
 * @property string $endtime
 * @property integer $typeid
 * @property integer $statusid
 * @property integer $defaultlocationid
 */
class Event extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Event the static model class
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
		return 'event';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, description, typeid, statusid, defaultlocationid', 'required'),
			array('typeid, statusid, defaultlocationid', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, description, typeid, statusid, defaultlocationid', 'safe', 'on'=>'search'),
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
                    'type' => array(self::BELONGS_TO,    'EventType', 'typeid'),
                    'defaultLocation' => array(self::BELONGS_TO,    'EventLocation', 'defaultlocationid'),
                    'leaders' => array(self::MANY_MANY, 'User', 'event_leader(eventid,userid)'),
                    //'status' => array(self::BELONGS_TO, 'Even')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'description' => 'Description',
			'typeid' => 'Type',
                        'starttime' => 'Start time',
                        'endtime' => 'End time',
			'statusid' => 'Status',
			'defaultlocationid' => 'Default Location',
		);
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('typeid',$this->typeid);
		$criteria->compare('statusid',$this->statusid);
		$criteria->compare('defaultlocationid',$this->defaultlocationid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getRecentAttendeesOfType( $attendee_type)
        {
            $criteria = new CDbCriteria(); 
            $criteria->alias = 'participant';
            $criteria->join = 'LEFT JOIN meeting ON meeting.id = participant.meetingid LEFT JOIN user ON user.id = participant.userid';
            $criteria->condition = 'meeting.eventid='. $this->id.' AND participant.typeid = '.$attendee_type ;
            $criteria->group = 'userid';
            $criteria->order = 'user.lastname ASC';
            
            $participants=Attendee::model()->findAll($criteria);
            
            //throw new Exception(print_r($participants, true));
            
            return $participants;
        }
}
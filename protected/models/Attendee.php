<?php

/**
 * This is the model class for table "attendee".
 *
 * The followings are the available columns in table 'attendee':
 * @property integer $meetingid
 * @property integer $userid
 * @property string $createdate
 * @property integer $typeid
 */
class Attendee extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Attendee the static model class
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
		return 'attendee';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('meetingid, userid, typeid, createdate', 'required'),
			array('meetingid, userid, typeid', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('meetingid, userid, createdate, typeid', 'safe', 'on'=>'search'),
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
                    'user' => array(self::BELONGS_TO, 'User','userid'),
                    'meeting' => array(self::BELONGS_TO, 'Meeting','meetingid'),
                    'type' => array(self::BELONGS_TO, 'AttendeeType','typeid')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'meetingid' => 'Meetingid',
			'userid' => 'Userid',
			'createdate' => 'Createdate',
                        'typeid' => 'Typeid',
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

		$criteria->compare('meetingid',$this->meetingid);
		$criteria->compare('userid',$this->userid);
		$criteria->compare('createdate',$this->createdate,true);
                $criteria->compare('typeid',$this->typeid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function beforeValidate()
        {
            if(parent::beforeValidate())
            {
                if($this->isNewRecord)
                {
                    $this->createdate = new CDbExpression('now()');
                }
                return true;
            }
            
        }
}
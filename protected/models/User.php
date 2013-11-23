<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $firstname
 * @property string $lastname
 * @property string $phone
 * @property string $sendhubid
 * @property string $address1
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property string $dateofbirth
 * @property string $firstcontact
 * @property string $school
 * @property string $notes
 * @property string $password
 * 
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('firstname, lastname, phone', 'required'),
			array('username, address1, city, state, zip, school, password', 'length','max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, firstname, lastname, phone, sendhubid, dateofbirth, firstcontact,notes', 'safe'),
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
                    'eventsleading' => array(self::MANY_MANY, 'Event', 'event_leader(userid,eventid)')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
                        'firstname' => 'First Name',
                        'lastname' => 'Last Name',
                        'phone' => 'Phone', 
                        'sendhubid' => 'SendHubId',
                        'address1' => 'Address',
                        'city' => 'City',
                        'state' => 'State',
                        'zip' => 'Zip',
                        'dateofbirth' => 'Date of Birth',
                        'firstcontact' => 'First Contact',
                        'school' => 'School Info',
                        'notes' => 'Notes',
                        //'' => '',
                    
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
		$criteria->compare('username',$this->username,true);
                $criteria->compare('firstname',$this->firstname,true);
                $criteria->compare('lastname',$this->lastname,true);
                $criteria->compare('phone',$this->phone, true);
                $criteria->compare('sendhubid',$this->sendhubid, true);
                

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public static function getByPhone($number)
        {
            if(!$number)
                return null;
            
            //$criteria=new CDbCriteria(); 
            //$criteria->compare('phone', $number);
            
            return User::model()->findByAttributes(array('phone' => $number));
            
        }
        
        
        public function beforeValidate()
        {
            if(parent::beforeValidate())
            {
                $this->dateofbirth = date('Y-m-d', strtotime($this->dateofbirth));
                $this->firstcontact = date('Y-m-d', strtotime($this->firstcontact));
                
                return true;
            }
            
        }
}
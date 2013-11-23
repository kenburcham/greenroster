<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
        private $_user;
    
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
            if(!isset($this->username))
            {
                $this->errorCode=self::ERROR_USERNAME_INVALID;
                return !$this->errorCode;
            }
            
            //look up user by username
            $user = User::model()->findByAttributes(array('username' => $this->username));
            
            
            
            if($user == null )
            {
                $this->errorCode=self::ERROR_USERNAME_INVALID;
             
            } elseif($this->password !== $user->password) { //authenticate
                $this->errorCode=self::ERROR_PASSWORD_INVALID;
            } else
            {
                $this->_user = $user;
                $this->errorCode=self::ERROR_NONE;
            }
            
            
            
            //override methods and wrap our user object.  we become Yii::app()->user
            
            //change the OTHER places where we are using "3" or something, to fetch our actual id.
		
            return !$this->errorCode;
	}
        
        public function getId()
        {
            return $this->_user->id;
        }
        
        public function getName()
        {
            return $this->_user->firstname;
        }
        
        
}
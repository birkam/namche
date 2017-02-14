<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    public $_id;
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
        $data = UserAccount::model()->findByAttributes(array('user_name'=>$this->username));

        if($data === null)
        {
            $this->_id = 'user Null';
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        }
        else if(sha1(md5($this->password)) != $data->password)
        {
            $this->_id = $this->id;
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        }
        else
        {
            $this->setState('user_ac_id', $data->id);
            $this->setState('user_det_id', $data->user_id);
            $this->setState('id', $data->id);
            $this->_id = $data->id;
            $this->errorCode=self::ERROR_NONE;
        }
		return !$this->errorCode;
	}
    public function getId()
    {
        return $this->_id;
    }
}
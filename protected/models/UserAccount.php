<?php

/**
 * This is the model class for table "tbl_user_account".
 *
 * The followings are the available columns in table 'tbl_user_account':
 * @property string $id
 * @property string $user_id
 * @property string $email
 * @property string $user_name
 * @property string $password
 * @property integer $role
 * @property integer $status
 * @property string $created_by
 * @property string $created_date
 */
class UserAccount extends CActiveRecord
{
    public $repeat_password;
    public $old_password;
    public $new_password;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_user_account';
	}

    public function behaviors()
    {
        return array(
            // Classname => path to Class
            'ActiveRecordLogableBehavior'=>
                'application.behaviors.ActiveRecordLogableBehavior',
        );
    }
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('user_name, password, repeat_password, role, status', 'required'),
			array('role, status', 'numerical', 'integerOnly'=>true),
			array('user_id, created_by', 'length', 'max'=>20),
			array('email', 'length', 'max'=>40),
			array('user_name', 'length', 'max'=>30),
			array('password', 'length', 'max'=>100),
            array('email','email'),
			array('created_date', 'safe'),
            array('user_name', 'unique', 'message' => ("This User Name Already Exists.")),
            array('user_name', 'length', 'max'=>20, 'min' => 3,'message' =>("Incorrect username (length between 3 and 20 characters).")),
            array('user_name', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u','message' => ("Incorrect symbols (A-z0-9).")),
            array('old_password, new_password, repeat_password', 'required', 'on' => 'changePwd'),
            array('old_password', 'findPasswords', 'on' => 'changePwd'),
            array('repeat_password', 'compare', 'compareAttribute'=>'new_password', 'on'=>'changePwd'),
     //       array('repeat_password', 'compare', 'compareAttribute'=>'password', 'message'=>'Passwords donot match!'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, email, user_name, password, role, status, created_by, created_date', 'safe', 'on'=>'search'),
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
		);
	}


    public function beforeSave()
    {
        $Pass = sha1(md5($this->password));
        $this->password = $Pass;
        return true;
    }
    public function findPasswords($attribute, $params)
    {
        $user = UserAccount::model()->findByPk(Yii::app()->user->user_ac_id);
        if ($user->password != sha1(md5($this->old_password)))
            $this->addError($attribute, 'Old password is incorrect.');
    }
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'email' => 'Email',
			'user_name' => 'User Name',
			'password' => 'Password',
			'role' => 'Role',
			'status' => 'Status',
			'created_by' => 'Created By',
			'created_date' => 'Created Date',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('role',$this->role);
		$criteria->compare('status',$this->status);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('created_date',$this->created_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserAccount the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

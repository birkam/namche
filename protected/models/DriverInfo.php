<?php

/**
 * This is the model class for table "tbl_driver_info".
 *
 * The followings are the available columns in table 'tbl_driver_info':
 * @property string $id
 * @property string $fname
 * @property string $mname
 * @property string $lname
 * @property string $photo
 * @property string $address
 * @property string $gender
 * @property string $date_of_birth
 * @property string $mobile
 * @property string $landline
 * @property string $em_contact_name
 * @property string $em_contact_relation
 * @property string $em_contact_number
 * @property string $created_by
 * @property string $created_date
 */
class DriverInfo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_driver_info';
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
            array('fname, lname, address, gender, licence_no, licence_issue_date, licence_exp_date, citizenship_no, blood_group, created_by, created_date', 'required'),
            array('licence_authorized_drive', 'required', 'message'=>'Please check at least one checkbox!'),
//            array('photo','required','on'=>'create'),
//            array('photo', 'file', 'allowEmpty' => TRUE,'types' => 'jpg, jpeg, gif, png','on'=>'update'),
            array('mobile', 'PcSimplePhoneValidator'),
            array('landline', 'LandlineValid'),
            array('photo', 'file', 'allowEmpty'=>true, 'types'=>'jpg, gif, png, jpeg','maxSize'=>1024*5,'on'=>'insert'),
            array('photo', 'file', 'allowEmpty'=>true, 'types' => 'jpg, gif, png, jpeg', 'maxSize'=>1024 * 150, 'tooLarge'=>'Photo must be smaller than 150KB'),
			array('fname, mname, lname, mobile, landline, em_contact_number, created_by', 'length', 'max'=>20),
            array('fname, mname, lname', 'length', 'min'=>2),
			array('photo', 'length', 'max'=>100),
			array('address', 'length', 'max'=>50),
			array('gender, date_of_birth', 'length', 'max'=>10),
			array('em_contact_name, em_contact_relation', 'length', 'max'=>40),
			array('created_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fname, mname, lname, photo, address, gender, date_of_birth, mobile, landline, em_contact_name, em_contact_relation, em_contact_number, created_by, created_date', 'safe', 'on'=>'search'),
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

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fname' => 'First Name',
			'mname' => 'Middle Name',
			'lname' => 'Last Name',
			'photo' => 'Photo',
			'address' => 'Address',
			'gender' => 'Gender',
			'date_of_birth' => 'Date Of Birth',
			'mobile' => 'Mobile Number',
			'landline' => 'Landline Number',
			'em_contact_name' => 'Emergency Contact Name',
			'em_contact_relation' => 'Emergency Contact Relation',
			'em_contact_number' => 'Emergency Contact Number',
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
		$criteria->compare('fname',$this->fname,true);
		$criteria->compare('mname',$this->mname,true);
		$criteria->compare('lname',$this->lname,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('date_of_birth',$this->date_of_birth,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('landline',$this->landline,true);
		$criteria->compare('em_contact_name',$this->em_contact_name,true);
		$criteria->compare('em_contact_relation',$this->em_contact_relation,true);
		$criteria->compare('em_contact_number',$this->em_contact_number,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('created_date',$this->created_date,true);

        return new CActiveDataProvider( $this, array(
            'criteria'   => $criteria,
            'pagination' => array(
                'pageSize' => Yii::app()->user->getState( 'pageSize', Yii::app()->params[ 'defaultPageSize' ] ),
            ),
        ) );
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DriverInfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

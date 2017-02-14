<?php

/**
 * This is the model class for table "tbl_bus_owner_contact".
 *
 * The followings are the available columns in table 'tbl_bus_owner_contact':
 * @property string $id
 * @property string $busOwnerId
 * @property string $mobile
 * @property string $landline
 * @property string $email
 * @property string $workPhone
 * @property string $created_by
 * @property string $created_date
 */
class BusOwnerContact extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_bus_owner_contact';
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
            array('mobile', 'required'),
			array('busOwnerId, created_by', 'length', 'max'=>20),
            array('mobile', 'PcSimplePhoneValidator'),
            array('landline, workPhone', 'LandlineValid'),
			array('mobile, landline, workPhone', 'length', 'max'=>15),
			array('email', 'length', 'max'=>50),
            array('email', 'email'),
			array('created_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, busOwnerId, mobile, landline, email, workPhone, created_by, created_date', 'safe', 'on'=>'search'),
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
			'busOwnerId' => 'Bus Owner',
			'mobile' => 'Mobile',
			'landline' => 'Landline',
			'email' => 'Email',
			'workPhone' => 'Work Phone',
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
		$criteria->compare('busOwnerId',$this->busOwnerId,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('landline',$this->landline,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('workPhone',$this->workPhone,true);
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
	 * @return BusOwnerContact the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

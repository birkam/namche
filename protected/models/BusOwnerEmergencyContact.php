<?php

/**
 * This is the model class for table "tbl_bus_owner_emergency_contact".
 *
 * The followings are the available columns in table 'tbl_bus_owner_emergency_contact':
 * @property string $id
 * @property string $busOwnerId
 * @property string $name
 * @property string $relationship
 * @property string $mobile_no
 * @property string $landline
 * @property string $created_by
 * @property string $created_date
 */
class BusOwnerEmergencyContact extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_bus_owner_emergency_contact';
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
            array('name, relationship, mobile_no, landline', 'safe'),
            array('mobile_no', 'PcSimplePhoneValidator'),
            array('landline', 'LandlineValid'),
			array('busOwnerId, created_by', 'length', 'max'=>20),
			array('name, relationship', 'length', 'max'=>50),
			array('mobile_no, landline', 'length', 'max'=>15),
			array('created_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, busOwnerId, name, relationship, mobile_no, landline, created_by, created_date', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'relationship' => 'Relationship',
			'mobile_no' => 'Mobile No',
			'landline' => 'Landline',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('relationship',$this->relationship,true);
		$criteria->compare('mobile_no',$this->mobile_no,true);
		$criteria->compare('landline',$this->landline,true);
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
	 * @return BusOwnerEmergencyContact the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

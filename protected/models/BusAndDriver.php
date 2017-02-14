<?php

/**
 * This is the model class for table "tbl_bus_and_driver".
 *
 * The followings are the available columns in table 'tbl_bus_and_driver':
 * @property string $id
 * @property string $bus_id
 * @property string $driver_id
 * @property integer $driver_status
 * @property string $driver_entered_date
 * @property string $driver_left_date
 * @property string $created_by
 * @property string $created_date
 */
class BusAndDriver extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_bus_and_driver';
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
            array('driver_id, driver_entered_date', 'required'),
			array('driver_status', 'numerical', 'integerOnly'=>true),
			array('bus_id, driver_id, created_by', 'length', 'max'=>20),
			array('driver_entered_date, driver_left_date', 'length', 'max'=>10),
			array('created_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, bus_id, driver_id, driver_status, driver_entered_date, driver_left_date, created_by, created_date', 'safe', 'on'=>'search'),
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
			'bus_id' => 'Bus',
			'driver_id' => 'Driver',
			'driver_status' => 'Driver Status',
			'driver_entered_date' => 'Driver Entered Date',
			'driver_left_date' => 'Driver Left Date',
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
		$criteria->compare('bus_id',$this->bus_id,true);
		$criteria->compare('driver_id',$this->driver_id,true);
		$criteria->compare('driver_status',$this->driver_status);
		$criteria->compare('driver_entered_date',$this->driver_entered_date,true);
		$criteria->compare('driver_left_date',$this->driver_left_date,true);
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
	 * @return BusAndDriver the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

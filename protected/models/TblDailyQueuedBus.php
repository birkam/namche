<?php

/**
 * This is the model class for table "tbl_daily_queued_bus".
 *
 * The followings are the available columns in table 'tbl_daily_queued_bus':
 * @property integer $id
 * @property integer $daily_bus_queue_id
 * @property integer $time_id
 * @property integer $bus_id
 * @property integer $queue_serial
 * @property integer $payment_status
 * @property integer $bus_remove_type
 */
class TblDailyQueuedBus extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_daily_queued_bus';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('daily_bus_queue_id, time_id, bus_id, queue_serial, payment_status', 'required'),
			array('daily_bus_queue_id, time_id, bus_id, queue_serial, payment_status, bus_remove_type', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, daily_bus_queue_id, time_id, bus_id, queue_serial, payment_status, bus_remove_type', 'safe', 'on'=>'search'),
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
			'daily_bus_queue_id' => 'Daily Bus Queue',
			'time_id' => 'Time',
			'bus_id' => 'Bus',
			'queue_serial' => 'Queue Serial',
			'payment_status' => 'Payment Status',
			'bus_remove_type' => 'Bus Remove Type',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('daily_bus_queue_id',$this->daily_bus_queue_id);
		$criteria->compare('time_id',$this->time_id);
		$criteria->compare('bus_id',$this->bus_id);
		$criteria->compare('queue_serial',$this->queue_serial);
		$criteria->compare('payment_status',$this->payment_status);
		$criteria->compare('bus_remove_type',$this->bus_remove_type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TblDailyQueuedBus the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

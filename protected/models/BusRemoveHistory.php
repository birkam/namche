<?php

/**
 * This is the model class for table "tbl_bus_remove_history".
 *
 * The followings are the available columns in table 'tbl_bus_remove_history':
 * @property integer $id
 * @property integer $remove_type
 * @property integer $daily_bus_queue_id
 * @property integer $daily_queued_bus_id
 * @property integer $old_bus_id
 * @property integer $new_bus_id
 * @property string $remarks
 * @property integer $created_by
 * @property string $created_date
 */
class BusRemoveHistory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_bus_remove_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		//replace type=> 1 = temp, 2=permanent
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('remove_type, daily_bus_queue_id, daily_queued_bus_id, old_bus_id, new_bus_id, remarks, created_by, created_date', 'required'),
			array('remove_type, daily_bus_queue_id, daily_queued_bus_id, old_bus_id, new_bus_id, created_by', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, remove_type, daily_bus_queue_id, daily_queued_bus_id, old_bus_id, new_bus_id, remarks, created_by, created_date', 'safe', 'on'=>'search'),
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
			'remove_type' => 'Remove Type',
			'daily_bus_queue_id' => 'Daily Bus Queue',
			'daily_queued_bus_id' => 'Daily Queued Bus',
			'old_bus_id' => 'Old Bus',
			'new_bus_id' => 'New Bus',
			'remarks' => 'Remarks',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('remove_type',$this->remove_type);
		$criteria->compare('daily_bus_queue_id',$this->daily_bus_queue_id);
		$criteria->compare('daily_queued_bus_id',$this->daily_queued_bus_id);
		$criteria->compare('old_bus_id',$this->old_bus_id);
		$criteria->compare('new_bus_id',$this->new_bus_id);
		$criteria->compare('remarks',$this->remarks,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_date',$this->created_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BusRemoveHistory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

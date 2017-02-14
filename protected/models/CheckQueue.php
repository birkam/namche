<?php

/**
 * This is the model class for table "tbl_check_queue".
 *
 * The followings are the available columns in table 'tbl_check_queue':
 * @property integer $id
 * @property integer $route_id
 * @property integer $time_id
 * @property integer $completed_time
 * @property string $bus_id
 * @property integer $stats
 */
class CheckQueue extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_check_queue';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('route_id, time_id, completed_time, bus_id, stats', 'safe'),
			array('route_id, time_id, completed_time, stats', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, route_id, time_id, completed_time, bus_id, stats', 'safe', 'on'=>'search'),
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
			'route_id' => 'Route',
			'time_id' => 'Time',
			'completed_time' => 'Completed Time',
			'bus_id' => 'Bus',
			'stats' => 'Stats',
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
		$criteria->compare('route_id',$this->route_id);
		$criteria->compare('time_id',$this->time_id);
		$criteria->compare('completed_time',$this->completed_time);
		$criteria->compare('bus_id',$this->bus_id,true);
		$criteria->compare('stats',$this->stats);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CheckQueue the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

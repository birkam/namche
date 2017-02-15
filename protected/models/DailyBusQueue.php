<?php

/**
 * This is the model class for table "tbl_daily_bus_queue".
 *
 * The followings are the available columns in table 'tbl_daily_bus_queue':
 * @property string $id
 * @property integer $route_id
 * @property string $queue_date
 * @property string $time_id
 * @property string $bus_id
 * @property string $queue_serial
 * @property integer $bus_status
 * @property string $created_by
 * @property string $created_date
 */
class DailyBusQueue extends CActiveRecord
{
    public $route_name;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_daily_bus_queue';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
        $calendar = new DateConverter();
        $engDate = date('Y-m-d', time());
        if(!empty($engDate)){
            list($eDate, $emonth, $eday) =explode("-",$engDate);

            $cal = $calendar->eng_to_nep($eDate, $emonth, $eday);
            if(strlen($cal['date'])==2 && strlen($cal['month']) == 2){
                $nepali_date = $cal['year'] . '-' . $cal['month'] . '-' . $cal['date'];
            }elseif(strlen($cal['date'])==1 && strlen($cal['month']) == 2){
                $nepali_date = $cal['year'] . '-' . $cal['month'] . '-' .'0'. $cal['date'];
            }elseif(strlen($cal['date'])==2 && strlen($cal['month']) == 1){
                $nepali_date = $cal['year'] . '-' .'0'. $cal['month'] . '-' . $cal['date'];
            }elseif(strlen($cal['date'])==1 && strlen($cal['month']) == 1){
                $nepali_date = $cal['year'] . '-' .'0'. $cal['month'] . '-' .'0'. $cal['date'];
            }
        }
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('queue_date', 'required'),
			array('route_id, bus_status', 'numerical', 'integerOnly'=>true),
			array('queue_date', 'length', 'max'=>10),
			array('time_id, bus_id, queue_serial', 'length', 'max'=>300),
			array('created_by', 'length', 'max'=>20),
            array( 'queue_date','compare','compareValue' => $nepali_date,'operator'=>'>=', 'allowEmpty'=>'false', 'message' => '{attribute} should be later than or equal to "{compareValue}".'),
    //        array('queue_date', ''),
			array('created_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, route_id, queue_date, time_id, route_name, bus_id, queue_serial, bus_status, created_by, created_date', 'safe', 'on'=>'search'),
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
            'bus_route'=>array(self::BELONGS_TO, 'Route', 'route_id'),
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
			'queue_date' => 'Queue Date',
			'time_id' => 'Time',
			'bus_id' => 'Bus',
			'queue_serial' => 'Queue Serial',
			'bus_status' => 'Bus Status',
			'created_by' => 'Created By',
			'created_date' => 'Created Date',
            'route_name' => 'Route Name',
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
        $criteria->with = array('bus_route');
		$criteria->compare('id',$this->id,true);
		$criteria->compare('route_id',$this->route_id);
        $criteria->compare('bus_route.route_name', $this->route_name, true);
		$criteria->compare('queue_date',$this->queue_date,true);
		$criteria->compare('time_id',$this->time_id,true);
		$criteria->compare('bus_id',$this->bus_id,true);
		$criteria->compare('queue_serial',$this->queue_serial,true);
		$criteria->compare('bus_status',$this->bus_status);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('created_date',$this->created_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'attributes'=>array(
                    'route_name'=>array(
                        'asc'=>'bus_route.route_name',
                        'desc'=>'bus_route.route_name DESC',
                    ),
                    '*',
                ),
            ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DailyBusQueue the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

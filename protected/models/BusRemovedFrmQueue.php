<?php

/**
 * This is the model class for table "tbl_bus_removed_frm_queue".
 *
 * The followings are the available columns in table 'tbl_bus_removed_frm_queue':
 * @property string $id
 * @property integer $route_id
 * @property integer $bus_id
 * @property string $queue_date
 * @property string $created_date
 */
class BusRemovedFrmQueue extends CActiveRecord
{
    public $bus_numbers;
    public $route_names;
    public $removed_by;
    public $time;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_bus_removed_frm_queue';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('route_id, bus_id, time_id, created_by', 'numerical', 'integerOnly'=>true),
			array('queue_date', 'length', 'max'=>10),
			array('created_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('route_names, bus_numbers, time, removed_by, id, route_id, bus_id, time_id, queue_date, created_by, created_date', 'safe', 'on'=>'search'),
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
            'busdetail'=>array(self::BELONGS_TO, 'Bus', 'bus_id'),
            'route'=>array(self::BELONGS_TO, 'Route', 'route_id'),
            'timedetail'=>array(self::BELONGS_TO, 'RouteTime', 'time_id'),
            'created'=>array(self::BELONGS_TO, 'UserAccount', 'created_by'),
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
			'bus_id' => 'Bus',
			'queue_date' => 'Queue Date',
            'time_id' => 'Time Id',
			'created_date' => 'Created Date',
            'created_by' => 'Created By',
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
//        $criteria->with = array('route');
        $criteria->with = array('busdetail', 'route', 'created', 'timedetail');
        $criteria->compare('id',$this->id,true);
		$criteria->compare('route_id',$this->route_id);
		$criteria->compare('bus_id',$this->bus_id);
		$criteria->compare('time_id',$this->time_id);
        $criteria->compare('route.route_name', $this->route_names, true);
        $criteria->compare('timedetail.route_time', $this->time, true);
        $criteria->compare('busdetail.bus_no', $this->bus_numbers, true);
        $criteria->compare('created.user_name', $this->removed_by, true);
		$criteria->compare('queue_date',$this->queue_date,true);
        $criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('created_date',$this->created_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'attributes'=>array(
                    'route_names'=>array(
                        'asc'=>'route.route_name',
                        'desc'=>'route.route_name DESC',
                    ),
                    'bus_numbers'=>array(
                        'asc'=>'busdetail.bus_no',
                        'desc'=>'busdetail.bus_no DESC',
                    ),
                    'removed_by'=>array(
                        'asc'=>'created.user_name',
                        'desc'=>'created.user_name DESC',
                    ),
                    'time'=>array(
                        'asc'=>'timedetail.route_time',
                        'desc'=>'timedetail.route_time DESC',
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
	 * @return BusRemovedFrmQueue the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

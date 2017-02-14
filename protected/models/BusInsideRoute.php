<?php

/**
 * This is the model class for table "tbl_bus_inside_route".
 *
 * The followings are the available columns in table 'tbl_bus_inside_route':
 * @property string $id
 * @property integer $route_id
 * @property string $bus_id
 * @property integer $bus_status
 * @property string $bus_assigned_date
 * @property string $bus_out_date
 * @property string $created_by
 * @property string $created_date
 */
class BusInsideRoute extends CActiveRecord
{
	public $bus_no;
    public $route_name;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_bus_inside_route';
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
            array('bus_id, bus_assigned_date','required'),
			array('route_id, bus_status', 'numerical', 'integerOnly'=>true),
			array('bus_id, created_by', 'length', 'max'=>20),
			array('bus_assigned_date, bus_out_date', 'length', 'max'=>10),
			array('created_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, route_id, bus_id, bus_no, route_name, bus_status, bus_assigned_date, bus_out_date, created_by, created_date', 'safe', 'on'=>'search'),
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
			'bus'=>array(self::BELONGS_TO, 'Bus', 'bus_id'),
            'route'=>array(self::BELONGS_TO, 'Route', 'route_id'),
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
			'bus_no'=>'Bus No',
			'bus_id' => 'Bus',
			'bus_status' => 'Bus Status',
			'bus_assigned_date' => 'Bus Assigned Date',
			'bus_out_date' => 'Bus Out Date',
			'created_by' => 'Created By',
			'created_date' => 'Created Date',
		);
	}
	public function stat($stat){
		if($stat == '1'){
			return 'Active';
		}elseif($stat == '0'){
			return 'Not Active';
		}
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
		$criteria->with = array('route','bus');
		$criteria->compare('id',$this->id,true);
		$criteria->compare('bus.bus_no', $this->bus_no, true);
        $criteria->compare('route.route_name', $this->route_name);
        $criteria->compare('route_id',$this->route_id);
		$criteria->compare('bus_id',$this->bus_id);
		$criteria->compare('bus_status',$this->bus_status);
		$criteria->compare('bus_assigned_date',$this->bus_assigned_date,true);
		$criteria->compare('bus_out_date',$this->bus_out_date,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('created_date',$this->created_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'attributes'=>array(
					'bus_no'=>array(
						'asc'=>'bus.bus_no',
						'desc'=>'bus.bus_no DESC',
					),
                    'route_name'=>array(
                        'asc'=>'route.route_name',
                        'desc'=>'route.route_name DESC',
                    ),
					'*',
				),
				'defaultOrder' => 'bus_status DESC, bus_out_date DESC',
			),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BusInsideRoute the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

<?php

/**
 * This is the model class for table "tbl_file_assignbus".
 *
 * The followings are the available columns in table 'tbl_file_assignbus':
 * @property string $id
 * @property string $fileno_id
 * @property string $bus_id
 * @property integer $bus_status
 * @property string $created_by
 * @property string $created_date
 */
class FileAssignbus extends CActiveRecord
{
    public $bus_number;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_file_assignbus';
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
            array('bus_status, fileno_id, bus_id, bus_entered_date, created_by, created_date', 'required'),
			array('bus_status', 'numerical', 'integerOnly'=>true),
			array('fileno_id, bus_id, created_by', 'length', 'max'=>20),
			array('owner_id, created_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fileno_id, bus_id, bus_entered_date, bus_number, bus_status, created_by, created_date, taken_out_date', 'safe', 'on'=>'search'),
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
            'user'=>array(self::BELONGS_TO, 'UserAccount', 'created_by'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fileno_id' => 'Fileno',
			'bus_id' => 'Bus',
			'bus_status' => 'Bus Status',
			'created_by' => 'Created By',
			'created_date' => 'Created Date',
            'taken_out_date'=>'Taken Out Date',
            'bus_entered_date'=>'Bus Entered Date'
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
        $criteria->with = array('bus');
		$criteria->compare('id',$this->id,true);
		$criteria->compare('fileno_id',$this->fileno_id);
		$criteria->compare('bus_id',$this->bus_id,true);
        $criteria->compare('bus.bus_no', $this->bus_number, true);
		$criteria->compare('bus_status',$this->bus_status);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('created_date',$this->created_date,true);
    	$criteria->compare('bus_entered_date',$this->taken_out_date,true);
		$criteria->compare('taken_out_date',$this->taken_out_date,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'attributes'=>array(
                    'bus_number'=>array(
                        'asc'=>'bus.bus_no',
                        'desc'=>'bus.bus_no DESC',
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
	 * @return FileAssignbus the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

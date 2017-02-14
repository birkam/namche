<?php

/**
 * This is the model class for table "tbl_bus_and_owner".
 *
 * The followings are the available columns in table 'tbl_bus_and_owner':
 * @property string $id
 * @property string $bus_id
 * @property string $owner_id
 * @property integer $owner_status
 * @property string $owner_date
 * @property string $left_date
 * @property string $created_by
 * @property string $created_date
 */
class BusAndOwner extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_bus_and_owner';
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
			array('owner_status', 'numerical', 'integerOnly'=>true),
			array('bus_id, owner_id, created_by', 'length', 'max'=>20),
			array('owner_date, left_date', 'length', 'max'=>10),
			array('created_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, bus_id, owner_id, owner_status, owner_date, left_date, created_by, created_date', 'safe', 'on'=>'search'),
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
			'owner_id' => 'Owner',
			'owner_status' => 'Owner Status',
			'owner_date' => 'Owner Date',
			'left_date' => 'Left Date',
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
		$criteria->compare('owner_id',$this->owner_id,true);
		$criteria->compare('owner_status',$this->owner_status);
		$criteria->compare('owner_date',$this->owner_date,true);
		$criteria->compare('left_date',$this->left_date,true);
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
	 * @return BusAndOwner the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

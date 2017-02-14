<?php

/**
 * This is the model class for table "tbl_temp_address".
 *
 * The followings are the available columns in table 'tbl_temp_address':
 * @property string $id
 * @property string $busOwnerId
 * @property string $zone
 * @property string $district
 * @property integer $ward
 * @property string $vdc_municipality
 * @property string $tole
 * @property string $house_no
 * @property string $created_by
 * @property string $created_date
 */
class TempAddress extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_temp_address';
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
			array('ward', 'numerical', 'integerOnly'=>true),
			array('busOwnerId, zone, district, house_no, created_by', 'length', 'max'=>20),
			array('vdc_municipality, tole', 'length', 'max'=>50),
			array('created_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, busOwnerId, zone, district, ward, vdc_municipality, tole, house_no, created_by, created_date', 'safe', 'on'=>'search'),
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
			'zone' => 'Zone',
			'district' => 'District',
			'ward' => 'Ward',
			'vdc_municipality' => 'Vdc Municipality',
			'tole' => 'Tole',
			'house_no' => 'House No',
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
		$criteria->compare('zone',$this->zone,true);
		$criteria->compare('district',$this->district,true);
		$criteria->compare('ward',$this->ward);
		$criteria->compare('vdc_municipality',$this->vdc_municipality,true);
		$criteria->compare('tole',$this->tole,true);
		$criteria->compare('house_no',$this->house_no,true);
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
	 * @return TempAddress the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

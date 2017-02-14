<?php

/**
 * This is the model class for table "tbl_bus_owner".
 *
 * The followings are the available columns in table 'tbl_bus_owner':
 * @property string $id
 * @property string $fname
 * @property string $id_no
 * @property string $photo
 * @property string $created_by
 * @property string $created_date
 */
class BusOwner extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_bus_owner';
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
            array('fname, lname, marital_status, gender, nationality, per_zone, per_district, per_ward, per_vdc_municipality', 'required'),

            array('fname, mname, lname', 'length', 'min'=>2),
			array('fname, mname, lname, created_by', 'length', 'max'=>20),
			array('id_no', 'length', 'max'=>30),
			array('photo', 'length', 'max'=>100),
			array('created_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fname, mname, lname, marital_status, gender, date_of_birth, nationality, id_no, photo, created_by, created_date', 'safe', 'on'=>'search'),
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
			'fname' => 'First Name',
            'mname' => 'Middle Name',
            'lname' => 'Last Name',
            'marital_status' => 'Marital Status',
            'gender' => 'Gender',
            'date_of_birth' => 'Date Of Birth',
            'nationality' => 'Nationality',
			'id_no' => 'Id No',
            'photo' => 'Photo',
            'per_zone'=>'Zone',
            'per_district'=>'District',
            'per_ward'=>'Ward',
            'per_vdc_municipality'=>'Vdc Municipality',
            'per_tole'=>'Tole',
            'per_house_no'=>'House No',
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
		$criteria->compare('fname',$this->fname,true);
        $criteria->compare('mname',$this->mname,true);
        $criteria->compare('lname',$this->lname,true);
		$criteria->compare('marital_status',$this->marital_status,true);
        $criteria->compare('gender',$this->gender,true);
        $criteria->compare('date_of_birth',$this->date_of_birth,true);
        $criteria->compare('nationality',$this->nationality,true);
		$criteria->compare('id_no',$this->id_no,true);
		$criteria->compare('photo',$this->photo,true);
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
	 * @return BusOwner the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

<?php

/**
 * This is the model class for table "tbl_fileno_bus".
 *
 * The followings are the available columns in table 'tbl_fileno_bus':
 * @property string $id
 * @property string $fileno_id
 * @property string $owner_id
 */
class FilenoBus extends CActiveRecord
{
    public $owner_fname;
    public $owner_mname;
    public $owner_lname;
    public $address;
    const Active = 1;
    const Inactive = 0;
    const Primary = 1;
    const Secondary = 2;

    public static $status = array(
        self::Active => 'Active',
        self::Inactive => 'Not Active',
    );

    public static $type = array(
        self::Primary => 'Primary',
        self::Secondary => 'Secondary',
    );
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_fileno_bus';
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
            array('owner_id, owned_date, owner_type', 'required'),
			array('fileno_id, owner_id', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fileno_id, owner_id, owner_status, owner_type,created_by, owned_date, created_date, owner_fname, owner_mname, owner_lname, address', 'safe', 'on'=>'search'),
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
            'fnb'=>array(self::BELONGS_TO, 'BusOwner', 'owner_id'),
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
			'owner_id' => 'Owner',
            'owner_type' => 'Owner Type',
            'owner_status'=>'Owner Status',
            'created_by'=>'Created By',
            'created_date'=>'Created Date',
            'owned_date'=>'Owned Date',
            'owner_fname'=>'First Name',
            'owner_mname'=>'Mid Name',
            'owner_lname'=>'Last Name',
		);
	}
    function checkType($type)
    {
        if ($type == '1') {
            return "Primary";
        } else if ($type == '2') {
            return "Secondary";
        }
    }
    function checkStat($stat)
    {
        if ($stat=='1') {
            return "Active";
        } else if ($stat=='0') {
            return "Not Active";
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
        $criteria->with = array('fnb');
		$criteria->compare('id',$this->id,true);
		$criteria->compare('fileno_id',$this->fileno_id);
		$criteria->compare('owner_id',$this->owner_id,true);
        $criteria->compare('owner_type',$this->owner_type,true);
        $criteria->compare('owner_status',$this->owner_status);
        $criteria->compare('owned_date',$this->owned_date,true);
        $criteria->compare('created_by',$this->created_by,true);
        $criteria->compare('created_date',$this->created_date,true);
        $criteria->compare('fnb.fname', ucwords($this->owner_fname), true);
        $criteria->compare('fnb.mname', $this->owner_mname, true);
        $criteria->compare('fnb.lname', $this->owner_lname, true);
//        $criteria->compare('fnb.address', $this->address, true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'attributes'=>array(
                    'owner_fname'=>array(
                        'asc'=>'fnb.fname',
                        'desc'=>'fnb.fname DESC',
                    ),
                    'owner_mname'=>array(
                        'asc'=>'fnb.mname',
                        'desc'=>'fnb.mname DESC',
                    ),
                    'owner_lname'=>array(
                        'asc'=>'fnb.lname',
                        'desc'=>'fnb.lname DESC',
                    ),
/*                    'address'=>array(
                        'asc'=>'fnb.address',
                        'desc'=>'fnb.address DESC',

                    ),*/
                    '*',
                ),
            ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FilenoBus the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

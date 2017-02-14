<?php

/**
 * This is the model class for table "tbl_file_no".
 *
 * The followings are the available columns in table 'tbl_file_no':
 * @property string $id
 * @property integer $file_no
 * @property string $created_by
 * @property string $created_date
 */
class FileNo extends CActiveRecord
{
	public $createdBy;
	public $bus_id_srch;
    public $owner_id_srch;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_file_no';
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
			array('file_no', 'required'),
			array('file_no', 'numerical', 'integerOnly'=>true),
			array('file_no', 'unique', 'message' => ("This File Number Already Exists.")),
			array('created_by', 'length', 'max'=>20),
			array('created_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, file_no, created_by, bus_id_srch, owner_id_srch, createdBy, created_date', 'safe', 'on'=>'search'),
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
			'file'=>array(self::BELONGS_TO, 'UserAccount', 'created_by'),
			'busInFile'=>array(self::HAS_MANY, 'FileAssignbus', 'fileno_id'),
            'ownInFile'=>array(self::HAS_MANY, 'FilenoBus', 'fileno_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'file_no' => 'File No',
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
		$criteria->with = array(
			'busInFile, ownInFile'=>array(
				'select' => false,
				'together'=>true
			)
		);
		$criteria->with = array('file');
		$criteria->compare('id',$this->id,true);
		$criteria->compare('file_no',$this->file_no);
		$criteria->compare('file.user_name', $this->createdBy, true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('created_date',$this->created_date,true);

		return new CActiveDataProvider($this, array(
            'pagination' => array(
                'pageSize' => Yii::app()->user->getState( 'pageSize', Yii::app()->params[ 'defaultPageSize' ] ),
            ),
			'criteria'=>$criteria,
			'sort'=>array(
				'attributes'=>array(
					'createdBy'=>array(
						'asc'=>'file.user_name',
						'desc'=>'file.user_name DESC',
					),
					'*',
				),
			),
		));
	}
	public function busId() {
		foreach ($this->busInFile as $bid) {
			if($bid->bus_status =='1') {
				$bus = Bus::model()->findByPk($bid->bus_id);
				return $this->bus_id_srch = $bus->bus_no;
			}
		}
	}
    public function ownerId() {
        foreach ($this->ownInFile as $oid) {
            if($oid->owner_status =='1') {
                $owner = BusOwner::model()->findByPk($oid->owner_id);
                return $this->owner_id_srch = $owner->fname.' '.$owner->mname.' '.$owner->lname;
            }
        }
    }
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FileNo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

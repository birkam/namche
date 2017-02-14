h<?php

/**
 * This is the model class for table "tbl_reserve".
 *
 * The followings are the available columns in table 'tbl_reserve':
 * @property string $id
 * @property string $bus_id
 * @property string $checked_cost_conf_id
 * @property double $samiti_sulka
 * @property double $bhalai_kosh
 * @property double $samrakshan
 * @property double $ticket
 * @property double $sahayog
 * @property double $bima
 * @property double $bibidh
 * @property double $mandir
 * @property double $jokhim
 * @property double $anugaman
 * @property double $bi_bya_sulka
 * @property double $ma_kosh
 * @property string $reserve_date
 * @property string $reserve_time
 * @property string $created_by
 * @property string $created_date
 */
class Reserve extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_reserve';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('samiti_sulka, reserve_date, reserve_time', 'required'),
			array('samiti_sulka, bhalai_kosh, samrakshan, ticket, sahayog, bima, bibidh, mandir, jokhim, anugaman, bi_bya_sulka, ma_kosh', 'numerical'),
			array('bus_id, checked_cost_conf_id, created_by', 'length', 'max'=>20),
			array('reserve_date', 'length', 'max'=>10),
			array('reserve_time', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, bus_id, checked_cost_conf_id, samiti_sulka, bhalai_kosh, samrakshan, ticket, sahayog, bima, bibidh, mandir, jokhim, anugaman, bi_bya_sulka, ma_kosh, reserve_date, reserve_time, created_by, created_date', 'safe', 'on'=>'search'),
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
			'checked_cost_conf_id' => 'Checked Cost Conf',
			'samiti_sulka' => 'Reserve Sulka',
			'bhalai_kosh' => 'Bhalai Kosh',
			'samrakshan' => 'Samrakshan',
			'ticket' => 'Ticket',
			'sahayog' => 'Sahayog',
			'bima' => 'Bima',
			'bibidh' => 'Bibidh',
			'mandir' => 'Mandir',
			'jokhim' => 'Jokhim',
			'anugaman' => 'Anugaman',
			'bi_bya_sulka' => 'Bi Bya Sulka',
			'ma_kosh' => 'Ma Kosh',
			'reserve_date' => 'Reserve Date',
			'reserve_time' => 'Reserve Time',
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
		$criteria->compare('checked_cost_conf_id',$this->checked_cost_conf_id,true);
		$criteria->compare('samiti_sulka',$this->samiti_sulka);
		$criteria->compare('bhalai_kosh',$this->bhalai_kosh);
		$criteria->compare('samrakshan',$this->samrakshan);
		$criteria->compare('ticket',$this->ticket);
		$criteria->compare('sahayog',$this->sahayog);
		$criteria->compare('bima',$this->bima);
		$criteria->compare('bibidh',$this->bibidh);
		$criteria->compare('mandir',$this->mandir);
		$criteria->compare('jokhim',$this->jokhim);
		$criteria->compare('anugaman',$this->anugaman);
		$criteria->compare('bi_bya_sulka',$this->bi_bya_sulka);
		$criteria->compare('ma_kosh',$this->ma_kosh);
		$criteria->compare('reserve_date',$this->reserve_date,true);
		$criteria->compare('reserve_time',$this->reserve_time,true);
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
	 * @return Reserve the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

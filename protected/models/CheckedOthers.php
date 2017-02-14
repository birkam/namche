<?php

/**
 * This is the model class for table "tbl_checked_others".
 *
 * The followings are the available columns in table 'tbl_checked_others':
 * @property string $id
 * @property string $bus_id
 * @property string $checked_cost_conf_id
 * @property string $particular
 * @property double $amount
 * @property string $created_by
 * @property string $created_date
 */
class CheckedOthers extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_checked_others';
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
			array('amount', 'numerical'),
			array('bus_id, checked_cost_conf_id, created_by', 'length', 'max'=>20),
			array('particular', 'length', 'max'=>200),
			array('created_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, bus_id, checked_cost_conf_id, particular, amount, created_by, created_date, created_nep_date', 'safe', 'on'=>'search'),
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
			'particular' => 'Particular',
			'amount' => 'Amount',
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
		$criteria->compare('particular',$this->particular,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('created_date',$this->created_date,true);
        $criteria->compare('created_nep_date',$this->created_nep_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CheckedOthers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

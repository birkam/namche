<?php

/**
 * This is the model class for table "tbl_checked_cost_configuration".
 *
 * The followings are the available columns in table 'tbl_checked_cost_configuration':
 * @property string $id
 * @property string $bus_id
 * @property integer $checked_id
 * @property string $created_by
 * @property string $created_date
 */
class CheckedCostConfiguration extends CActiveRecord
{
    public $bus_no;
    public $cashier;
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'tbl_checked_cost_configuration';
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
            array('bus_id, file_no_id, owners_id', 'required'),
            array('bus_id, checked_others', 'numerical', 'integerOnly'=>true),
            array('checked_id', 'length', 'max'=>200),
            array('bus_id, driver_id, created_by', 'length', 'max'=>20),
            array('created_date, receipt_no', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, receipt_no, bus_id, checked_id, driver_id, checked_rate, bus_no, cashier, checked_others, created_by, created_date, created_nep_date', 'safe', 'on'=>'search'),
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
            'bus_id' => 'Bus',
            'checked_id' => 'Checked',
            'driver_id' => 'Driver',
            'checked_rate' => 'Checked Rate',
            'checked_others' => 'Checked Others',
            'receipt_no'=>'Receipt No',
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
        $criteria->with = array('bus','created');
        $criteria->compare('id',$this->id,true);
        $criteria->compare('bus.bus_no', $this->bus_no, true);
        $criteria->compare('created.user_name', $this->cashier, true);
        $criteria->compare('bus_id',$this->bus_id,true);
        $criteria->compare('receipt_no',$this->receipt_no,true);
        $criteria->compare('checked_id',$this->checked_id);
        $criteria->compare('driver_id',$this->driver_id);
        $criteria->compare('created_by',$this->created_by,true);
        $criteria->compare('created_date',$this->created_date,true);
        $criteria->compare('created_nep_date',$this->created_nep_date,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination' => array(
                'pageSize' => Yii::app()->user->getState( 'pageSize', Yii::app()->params[ 'defaultPageSize' ] ),
            ),
            'sort'=>array(
                'attributes'=>array(
                    'bus_no'=>array(
                        'asc'=>'bus.bus_no',
                        'desc'=>'bus.bus_no DESC',
                    ),
                    'cashier'=>array(
                        'asc'=>'created.user_name',
                        'desc'=>'created.user_name DESC',
                    ),
                    '*',
                ),
                'defaultOrder' => 'created_nep_date DESC',
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return CheckedCostConfiguration the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}

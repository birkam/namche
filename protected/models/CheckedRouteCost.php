<?php

/**
 * This is the model class for table "tbl_checked_route_cost".
 *
 * The followings are the available columns in table 'tbl_checked_route_cost':
 * @property string $id
 * @property string $bus_id
 * @property string $checked_cost_conf_id
 * @property integer $route_id
 */
class CheckedRouteCost extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'tbl_checked_route_cost';
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
            array('route_id, payment_type', 'numerical', 'integerOnly'=>true),
            array('samiti_sulka, bhalai_kosh, samrakshan, ticket, sahayog, bima, bibidh, mandir, jokhim, anugaman, bi_bya_sulka, ma_kosh', 'numerical'),
            array('bus_id, checked_cost_conf_id', 'length', 'max'=>20),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, bus_id, checked_cost_conf_id, route_id, queue_date, queue_time_id, payment_type, created_nep_date', 'safe', 'on'=>'search'),
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
            'route_id' => 'Route',
            'queue_date' => 'Queue Date',
            'queue_time_id' => 'Queue Time Id',
            'payment_type' => 'Payment Type',
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
        $criteria->compare('route_id',$this->route_id);
        $criteria->compare('queue_date',$this->queue_date);
        $criteria->compare('queue_time_id',$this->queue_time_id);
        $criteria->compare('payment_type',$this->payment_type);
        $criteria->compare('created_nep_date',$this->created_nep_date,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return CheckedRouteCost the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}

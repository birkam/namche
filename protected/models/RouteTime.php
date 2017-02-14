<?php

/**
 * This is the model class for table "tbl_route_time".
 *
 * The followings are the available columns in table 'tbl_route_time':
 * @property integer $id
 * @property integer $route_id
 * @property string $route_time
 * @property string $created_by
 * @property string $created_date
 */
class RouteTime extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'tbl_route_time';
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
            array('created_by', 'length', 'max'=>20),
            array('route_time, created_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, route_id, route_time, payment_type, created_by, created_date', 'safe', 'on'=>'search'),
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
            'route_id' => 'Route',
            'route_time' => 'Route Time',
            'payment_type' => 'Payment Type',
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

        $criteria->compare('id',$this->id);
        $criteria->compare('route_id',$this->route_id);
        $criteria->compare('route_time',$this->route_time,true);
        $criteria->compare('payment_type',$this->payment_type,true);
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
     * @return RouteTime the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}

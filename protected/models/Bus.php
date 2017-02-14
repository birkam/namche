<?php

/**
 * This is the model class for table "tbl_bus".
 *
 * The followings are the available columns in table 'tbl_bus':
 * @property string $id
 * @property string $bus_no
 * @property string $owned_date
 * @property string $model_no
 * @property integer $total_seat
 * @property string $engine_no
 * @property string $chhachis_no
 * @property string $company
 * @property string $registered_date
 * @property string $created_date
 * @property string $created_by
 */
class Bus extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'tbl_bus';
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
            array('bus_no, model_no, total_seat, engine_no, chhachis_no, company, registered_date', 'required'),
			array('bus_no, chhachis_no, engine_no', 'unique'),
            array('total_seat', 'numerical', 'integerOnly'=>true),
            array('bus_no, engine_no, chhachis_no, created_by', 'length', 'max'=>20),
            array('model_no, company', 'length', 'max'=>30),
            array('owned_date, registered_date, remarks, created_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, bus_no, owned_date, model_no, total_seat, engine_no, chhachis_no, company, registered_date, created_date, created_by', 'safe', 'on'=>'search'),
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
            'bus'=>array(self::BELONGS_TO, 'UserAccount', 'created_by'),
            'posts' => array(self::HAS_MANY, 'BusInsurance', 'id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'bus_no' => 'Bus No',
            'owned_date' => 'Ownership Date',
            'model_no' => 'Model No',
            'total_seat' => 'Total Seat',
            'engine_no' => 'Engine No',
            'chhachis_no' => 'Chhachis No',
            'company' => 'Mf. Company',
            'registered_date' => 'Registered Date',
            'remarks' => 'Remarks',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
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
        $criteria->compare('bus_no',$this->bus_no,true);
        $criteria->compare('owned_date',$this->owned_date,true);
        $criteria->compare('model_no',$this->model_no,true);
        $criteria->compare('total_seat',$this->total_seat);
        $criteria->compare('engine_no',$this->engine_no,true);
        $criteria->compare('chhachis_no',$this->chhachis_no,true);
        $criteria->compare('company',$this->company,true);
        $criteria->compare('registered_date',$this->registered_date,true);
        $criteria->compare('created_date',$this->created_date,true);
        $criteria->compare('created_by',$this->created_by,true);

        return new CActiveDataProvider( $this, array(
            'criteria'   => $criteria,
            'pagination' => array(
                'pageSize' => Yii::app()->user->getState( 'pageSize', Yii::app()->params[ 'defaultPageSize' ] ),
            ),
        ) );
    }


    public function searchExpiredOnly()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        /**/
        /*--------------------------Query to select bus_id of not expired insurance---------------------------------------------------*/
        $criteria1 = new CDbCriteria();
        $criteria1->condition = 'expiry_date > :expiry_date';
        $criteria1->group = 'bus_id';
        $criteria1->order = 'expiry_date DESC';
        $criteria1->params = array('expiry_date' => date('Y-m-d'));
        $notExpIns = BusInsurance::model()->findAll($criteria1);
        $notExpIns_arr = array();
        foreach($notExpIns as $notExp){
            $notExpIns_arr[] = $notExp->bus_id;
        }
        $notExpIns_arr_filtered=array_keys(array_count_values($notExpIns_arr));
        /*--------------------------Query ends here---------------------------------------------------*/

        /*--------------------------Query to select bus_id of all insurance(expired and not expired)------------------------------------*/
        $allIns_arr = array();
        $allIns = Bus::model()->findAll();
        foreach($allIns as $all){
            $allIns_arr[] = $all->id;
        }
        $allIns_arr_filtered=array_keys(array_count_values($allIns_arr));
        /*--------------------------Query ends here---------------------------------------------------*/

        $expiredIns_arr = array_diff($allIns_arr_filtered,$notExpIns_arr_filtered);

        /**/
        $criteria=new CDbCriteria;

        $criteria->compare('id',$expiredIns_arr);
        $criteria->compare('bus_no',$this->bus_no,true);
        $criteria->compare('owned_date',$this->owned_date,true);
        $criteria->compare('model_no',$this->model_no,true);
        $criteria->compare('total_seat',$this->total_seat);
        $criteria->compare('engine_no',$this->engine_no,true);
        $criteria->compare('chhachis_no',$this->chhachis_no,true);
        $criteria->compare('company',$this->company,true);
        $criteria->compare('registered_date',$this->registered_date,true);
        $criteria->compare('created_date',$this->created_date,true);
        $criteria->compare('created_by',$this->created_by,true);




//        $total_expired_no = count($expiredIns_arr);

        return new CActiveDataProvider( $this, array(
            'criteria'   => $criteria,
            'pagination' => array(
                'pageSize' => Yii::app()->user->getState( 'pageSize', Yii::app()->params[ 'defaultPageSize' ] ),
            ),
        ) );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Bus the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}

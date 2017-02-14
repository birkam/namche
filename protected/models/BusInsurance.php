<?php

/**
 * This is the model class for table "tbl_bus_insurance".
 *
 * The followings are the available columns in table 'tbl_bus_insurance':
 * @property string $id
 * @property string $bus_id
 * @property string $insurance_company
 * @property string $insurance_account
 * @property string $ac_holder_name
 * @property string $tax_invoice_no
 * @property string $police_no
 * @property string $issue_date
 * @property string $expiry_date
 * @property string $remarks
 * @property string $created_by
 * @property string $created_date
 */
class BusInsurance extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'tbl_bus_insurance';
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
            array('insurance_company, ac_holder_name, tax_invoice_no, police_no, expiry_date', 'required'),
            array('bus_id, created_by', 'length', 'max'=>20),
            array('insured_amount', 'numerical'),
            array('insurance_company, ac_holder_name', 'length', 'max'=>100),
            array('insurance_account, tax_invoice_no, police_no, agent_code', 'length', 'max'=>50),
            array('remarks', 'length', 'max'=>200),
            array('issue_date, expiry_date, created_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, bus_id, insurance_company, insurance_account, ac_holder_name, tax_invoice_no, police_no, issue_date, expiry_date, remarks, created_by, created_date', 'safe', 'on'=>'search'),
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
            'insurance_company' => 'Insurance Company',
            'insurance_account' => 'Bank Account Name',
            'ac_holder_name' => 'Account Holder Bimit Name',
            'tax_invoice_no' => 'Tax Invoice No',
            'police_no' => 'Policy No',
            'agent_code'=>'Agent Code',
            'insured_amount'=>'Insured Amount',
            'issue_date' => 'Issue Date',
            'expiry_date' => 'Expiry Date',
            'remarks' => 'Remarks',
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
        $criteria->compare('insurance_company',$this->insurance_company,true);
        $criteria->compare('insurance_account',$this->insurance_account,true);
        $criteria->compare('ac_holder_name',$this->ac_holder_name,true);
        $criteria->compare('tax_invoice_no',$this->tax_invoice_no,true);
        $criteria->compare('police_no',$this->police_no,true);
        $criteria->compare('issue_date',$this->issue_date,true);
        $criteria->compare('expiry_date',$this->expiry_date,true);
        $criteria->compare('remarks',$this->remarks,true);
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
     * @return BusInsurance the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Hero
 * Date: 5/1/2017
 * Time: 8:37 AM
 */
class ReplaceModel extends CFormModel
{
    public $replace_type;//replace type=> 1 = temp, 2=permanent
    public $dbq_id;
    public $dqb_id;
    public $replace_old_bus_id;
    public $replace_new_bus_id;
    public $remarks;
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('replace_type, dbq_id, dqb_id, replace_old_bus_id, replace_new_bus_id, remarks', 'required'),
            array('replace_type, dbq_id, dqb_id, replace_old_bus_id, replace_new_bus_id', 'numerical'),
//            array('remarks', 'length', 'max'=>200),
        );
    }
    
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'replace_type' => 'Replace Type',
            'replace_old_bus_id' => 'Replace Old Bus',
            'replace_new_bus_id' => 'Replace New Bus',
            'remarks' => 'Remarks',
        );
    }
}

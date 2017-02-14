<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'file-assignbus-form',
    'enableAjaxValidation'=>true,
));
?>
<?php
$fileAssignBus_arr = array();
$fileAssignBus = FileAssignbus::model()->findAllByAttributes(array('bus_status'=>1));
if(!empty($fileAssignBus)){
    foreach($fileAssignBus as $f_a_b){
        $fileAssignBus_arr[]=$f_a_b->bus_id;
    }
}
$already_selected_bus = array_keys(array_count_values($fileAssignBus_arr));

$bus = Bus::model()->findAll();
$arrayAllBus = array();
foreach($bus as $b){
    $arrayAllBus[] = $b->id;
}
$all_bus = array_keys(array_count_values($arrayAllBus));
$not_selected_bus = array_diff($all_bus,$already_selected_bus);

$criteria = new CDbCriteria();
$criteria->addInCondition('id', $not_selected_bus);
$criteria->order = "bus_no ASC";
$not_selected_all = Bus::model()->findAll($criteria);
//$not_selected_all = Bus::model()->findAllByAttributes(array('id'=>$not_selected_bus));
$arrayNotSelected = array();
foreach($not_selected_all as $b){
    $arrayNotSelected[$b->id] = $b->bus_no;
}
?>
<?php
//$owner_id_arr = array();
//$file_no_owner = FilenoBus::model()->findAllByAttributes(array('fileno_id'=>$fileId, 'owner_status'=>1));
//echo 'Current Active File No Owners = ';
//foreach($file_no_owner as $f_n_o){
//    $owner_id = $f_n_o->owner_id;
//
//    $owners = BusOwner::model()->findByPk($owner_id);
//    echo $owners->fname.' '.$owners->mname.' '.$owners->lname.', ';
//
////    $owner_id_arr[$owner_id]=$owner_id;
//}

//$owner_id_str = implode(', ', $owner_id_arr);


?>
<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>
<?php /*echo $form->dropDownListRow($model,'bus_id',$arrayNotSelected, array('prompt'=>'--Choose One--', 'class'=>'span5','maxlength'=>20)); */?>
<?php
$this->widget('ext.yii-selectize.YiiSelectize', array(
    'model' => $model,
    'attribute' => 'bus_id',
    'data' => $arrayNotSelected,
    'fullWidth' => false,
    'placeholder' => 'Type Here To Search!',
));
?>
<?php echo $form->textFieldRow($model,'bus_entered_date', array('class'=>'span5','maxlength'=>10, 'id'=>'bus_entered_date', 'placeholder'=>'yyyy-mm-dd')); ?>

<!--<div style="display: none">-->
<!--    --><?php //echo $form->textFieldRow($model,'owner_id', array('class'=>'span5','maxlength'=>200, 'value'=>$owner_id_str)); ?>
<!--</div>-->
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'submit',
        'type'=>'primary',
        'label'=>$model->isNewRecord ? 'Create' : 'Save',
    )); ?>
</div>

<?php $this->endWidget(); ?>
<script>
    $('#bus_entered_date').calendarsPicker({calendar: $.calendars.instance('nepali'), dateFormat: 'yyyy-mm-dd'});
</script>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'fileno-bus-form',
    'enableAjaxValidation'=>true,
)); ?>
<?php
$fileId = $_GET['id'];
$filenobus = FilenoBus::model()->findAllByAttributes(array('fileno_id'=>$fileId, 'owner_status'=>1));
$filenobusOwnerArray = array();
foreach($filenobus as $file){
    $filenobusOwnerArray[$file->owner_id] = $file->owner_id;
}
$sd = array_count_values($filenobusOwnerArray);
$selected = array_keys($sd);

$owners = BusOwner::model()->findAll();
$ownerArr = array();
$ownerName = array();
foreach($owners as $own){
    $ownerArr[$own->id] = $own->id;

}
$nsd = array_count_values($ownerArr);
$notselected = array_keys($nsd);

$diff = array_diff($notselected,$selected);

$criteria = new CDbCriteria();
$criteria->addInCondition("id", $diff);
$ownerNameArr = array();
$OwnerName = BusOwner::model()->findAll($criteria);
foreach($OwnerName as $name){
    $contact = BusOwnerContact::model()->findByAttributes(array('busOwnerId'=>$name->id));
    $ownerNameArr[$name->id]=$name->fname.' '.$name->mname.' '.$name->lname.', '.$contact->mobile;
}

?>
<p class="help-block">Fields with <span class="required">*</span> are required.</p>
<?php
//foreach($filenobus as $fnb){
//    echo $fnb->id.'. file='.$fnb->fileno_id.'. owner_id='.$fnb->owner_id;
//    echo '<br>';
//}
?>
<?php echo $form->errorSummary($model); ?>
<div style="display: none">
    <?php echo $form->textFieldRow($model,'fileno_id',  array('class'=>'span5','maxlength'=>20, 'value'=>$fileId)); ?>
</div>
<br/>
<?php echo $form->dropDownListRow($model,'owner_type',array('1'=>'Primary','2'=>'Secondary'), array('prompt'=>'--Choose One--')); ?>
<div class="row">
    <div class="span3" style="margin-left: 30px">
        <?php echo $form->labelEx($model,'owner_id');?>
        <?php
        $this->widget('ext.yii-selectize.YiiSelectize', array(
            'model' => $model,
            'attribute' => 'owner_id',
            'data' => $ownerNameArr,
//            'fullWidth' => false,
            'placeholder' => 'Type Here To Search!',
        ));
        ?>
        <?php echo $form->error($model,'owner_id');?>
    </div>
</div>
<?php echo $form->textFieldRow($model,'owned_date',  array('class'=>'','maxlength'=>10, 'id'=>'owned_date')); ?>
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'submit',
        'type'=>'primary',
        'label'=>$model->isNewRecord ? 'Create' : 'Save',
    )); ?>
</div>
<?php $this->endWidget(); ?>
<script>
    $('#owned_date').calendarsPicker({calendar: $.calendars.instance('nepali'), dateFormat: 'yyyy-mm-dd'});
</script>
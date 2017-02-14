<style>
    .ui-multiselect{
        height: 28px;
    }
</style>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'bus-form',
    'enableAjaxValidation'=>true,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>
<div class="row-fluid">
    <div class="span4">
        <?php echo $form->textFieldRow($model,'bus_no',array('class'=>'span5','maxlength'=>20, 'id'=>'busno')); ?>
    </div>
    <div class="span4">
        <?php echo $form->textFieldRow($model,'owned_date',array('class'=>'span5','maxlength'=>30, 'id'=>'owned_date', 'placeholder'=>'yyyy-mm-dd')); ?>
    </div>

    <div class="span4">
        <?php echo $form->textFieldRow($model,'model_no',array('class'=>'span5','maxlength'=>30)); ?>
    </div>
</div>
<div class="row-fluid">
    <div class="span4">
        <?php echo $form->textFieldRow($model,'total_seat',array('class'=>'span5')); ?>
    </div>
    <div class="span4">
        <?php echo $form->textFieldRow($model,'engine_no',array('class'=>'span5','maxlength'=>20)); ?>
    </div>
    <div class="span4">
        <?php echo $form->textFieldRow($model,'chhachis_no',array('class'=>'span5','maxlength'=>20)); ?>
    </div>
</div>
<div class="row-fluid">
    <div class="span4">
        <?php echo $form->textFieldRow($model,'company',array('class'=>'span5','maxlength'=>30)); ?>
    </div>
    <div class="span4">
        <?php echo $form->textFieldRow($model,'registered_date',array('class'=>'span5','maxlength'=>30, 'id'=>'registered_date', 'placeholder'=>'yyyy-mm-dd')); ?>
    </div>
</div>
<div class="row-fluid">
    <div class="span4">
        <?php echo $form->textFieldRow($model,'remarks',array('class'=>'span12','maxlength'=>255)); ?>
    </div>
</div>
<!--<h3>Real Bus Owners</h3>
--><?php
/*$owner = BusOwner::model()->findAll();
$ownerArr = array();
foreach($owner as $ow){
    $ownerArr[$ow->id] = $ow->fname.' '.$ow->mname.' '.$ow->lname.', '.$ow->date_of_birth.', '.$ow->per_zone;
}
*/?>
<?php /*echo $form->labelEx($busAndOwner,'owner_id'); */?><!--
<?php /*$this->widget('ext.EchMultiSelect.EchMultiSelect', array(
    'model' => $busAndOwner,
    'dropDownAttribute' => 'owner_id',
    'data' => $ownerArr,
    'dropDownHtmlOptions'=> array(
        'style'=>'width:390px;',
    ),
    'options' => array(
        'checkAllText' => Yii::t('EchMultiSelect.EchMultiSelect','Check all'),
        'uncheckAllText' => Yii::t('EchMultiSelect.EchMultiSelect','Uncheck all'),
        'minWidth'=>100,
        'position'=>array('at'=>'left top', 'my'=>'left bottom'),
        'filter'=>true,
        'buttonWidth' => 120,
        'ajaxRefresh' => false,
        'show' => ['slide', 500],
        'hide' => ['slide', 500],
        'classes' => 'dynamic_multiselect'
    ),
    'filterOptions'=> array(
        'width'=>150,

    ),
));
*/?>
--><?php /*echo $form->textFieldRow($busAndOwner,'owner_date',array('class'=>'span4','maxlength'=>10, 'id'=>'owner_date', 'placeholder'=>'yyyy-mm-dd')); */?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'submit',
        'type'=>'primary',
        'label'=>$model->isNewRecord ? 'Create' : 'Save',
    )); ?>
</div>

<?php $this->endWidget(); ?>
<script>
    $('#owned_date, #registered_date').calendarsPicker({calendar: $.calendars.instance('nepali'), dateFormat: 'yyyy-mm-dd'});
    //$("#mySelector").append(" ");
    $( "#busno" ).keyup(function() {
        var str = $("#busno").val();
        str = str.replace(/(\d+)/g, function (_, num){
            return ' '+num+' ';
        });
        str = str.trim();
        string = str.replace(/\s\s+/g, ' ');
        $("#busno").val(string);
    });
</script>
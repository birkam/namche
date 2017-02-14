<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'daily-bus-queue-form',
    'enableAjaxValidation'=>true,
));
?>


<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php //echo $form->textFieldRow($model,'queue_date',array('class'=>'span5','maxlength'=>10)); ?>

<?php /*echo $form->labelEx($model,'queue_date'); */?>
<?php /*$this->widget('zii.widgets.jui.CJuiDatePicker',array(
        'model'=>$model,
        'attribute'=>'queue_date',
        'id' =>'queue_date',
        'name'=>'queue_date',
        'options' => array(
            'mode'=>'focus',
            'dateFormat'=>'yy-mm-dd',
            'showAnim' => 'slideDown',
            'changeMonth'=>true,
            'changeYear'=>true,
            'changeDay'=>true,
            'minDate'=>+0,
            'maxDate'=>"+7D",
        ),
        'htmlOptions'=>array(
            'size'=>25,
            'class'=>'date span5',
            'value'=>date('Y-m-d'),
            'readOnly'=>true
        ),
    )
);*/?>
<?php echo $form->textFieldRow($model,'queue_date', array('id'=>'queue_date')); ?>


<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'submit',
        'type'=>'primary',
        'label'=>$model->isNewRecord ? 'Create' : 'Save',
    )); ?>
</div>

<?php $this->endWidget(); ?>
<script>
    $('#queue_date').calendarsPicker({calendar: $.calendars.instance('nepali'), dateFormat: 'yyyy-mm-dd'});
</script>
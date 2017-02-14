<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'route-form',
	'enableAjaxValidation'=>false,
    'focus'=>array($model, 'route_name')
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'route_name',array('class'=>'span5','maxlength'=>200)); ?>

    <?php echo $form->textFieldRow($model,'distance_km',array('class'=>'span5','maxlength'=>200)); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>

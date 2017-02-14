<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'activerecordlog-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'description',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'action',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'model',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'idModel',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'field',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'creationdate',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'userid',array('class'=>'span5','maxlength'=>45)); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>

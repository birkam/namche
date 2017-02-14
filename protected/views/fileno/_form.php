<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'file-no-form',
	'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
)); ?>
<?php
$lastFileNo = Yii::app()->db->createCommand()->select('max(id) as max')->from('tbl_file_no')->queryScalar();
$newfileNo = $lastFileNo + 1;
?>
<!--<p class="help-block">Fields with <span class="required">*</span> are required.</p>-->
<!---->
<?php //echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'file_no',array('class'=>'span5', 'value'=>$newfileNo)); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>

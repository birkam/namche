<?php
/* @var $this RouteCostController */
/* @var $model RouteCost */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'route-cost-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'samiti_sulka'); ?>
		<?php echo $form->textField($model,'samiti_sulka'); ?>
		<?php echo $form->error($model,'samiti_sulka'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bhalai_kosh'); ?>
		<?php echo $form->textField($model,'bhalai_kosh'); ?>
		<?php echo $form->error($model,'bhalai_kosh'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'samrakshan'); ?>
		<?php echo $form->textField($model,'samrakshan'); ?>
		<?php echo $form->error($model,'samrakshan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ticket'); ?>
		<?php echo $form->textField($model,'ticket'); ?>
		<?php echo $form->error($model,'ticket'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sahayog'); ?>
		<?php echo $form->textField($model,'sahayog'); ?>
		<?php echo $form->error($model,'sahayog'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bima'); ?>
		<?php echo $form->textField($model,'bima'); ?>
		<?php echo $form->error($model,'bima'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bibidh'); ?>
		<?php echo $form->textField($model,'bibidh'); ?>
		<?php echo $form->error($model,'bibidh'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mandir'); ?>
		<?php echo $form->textField($model,'mandir'); ?>
		<?php echo $form->error($model,'mandir'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'jokhim'); ?>
		<?php echo $form->textField($model,'jokhim'); ?>
		<?php echo $form->error($model,'jokhim'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'anugaman'); ?>
		<?php echo $form->textField($model,'anugaman'); ?>
		<?php echo $form->error($model,'anugaman'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bi_bya_sulka'); ?>
		<?php echo $form->textField($model,'bi_bya_sulka'); ?>
		<?php echo $form->error($model,'bi_bya_sulka'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ma_kosh'); ?>
		<?php echo $form->textField($model,'ma_kosh'); ?>
		<?php echo $form->error($model,'ma_kosh'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php
/* @var $this RouteCostController */
/* @var $model RouteCost */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'route_id'); ?>
		<?php echo $form->textField($model,'route_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'samiti_sulka'); ?>
		<?php echo $form->textField($model,'samiti_sulka'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bhalai_kosh'); ?>
		<?php echo $form->textField($model,'bhalai_kosh'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'samrakshan'); ?>
		<?php echo $form->textField($model,'samrakshan'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ticket'); ?>
		<?php echo $form->textField($model,'ticket'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sahayog'); ?>
		<?php echo $form->textField($model,'sahayog'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bima'); ?>
		<?php echo $form->textField($model,'bima'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bibidh'); ?>
		<?php echo $form->textField($model,'bibidh'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mandir'); ?>
		<?php echo $form->textField($model,'mandir'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'jokhim'); ?>
		<?php echo $form->textField($model,'jokhim'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'anugaman'); ?>
		<?php echo $form->textField($model,'anugaman'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bi_bya_sulka'); ?>
		<?php echo $form->textField($model,'bi_bya_sulka'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ma_kosh'); ?>
		<?php echo $form->textField($model,'ma_kosh'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cost_status'); ?>
		<?php echo $form->textField($model,'cost_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_by'); ?>
		<?php echo $form->textField($model,'created_by',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_date'); ?>
		<?php echo $form->textField($model,'created_date'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
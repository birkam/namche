<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textFieldRow($model,'id',array('class'=>'span5','maxlength'=>20)); ?>

		<?php echo $form->textFieldRow($model,'bus_no',array('class'=>'span5','maxlength'=>20)); ?>

		<?php echo $form->textFieldRow($model,'owned_date',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'model_no',array('class'=>'span5','maxlength'=>30)); ?>

		<?php echo $form->textFieldRow($model,'total_seat',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'engine_no',array('class'=>'span5','maxlength'=>20)); ?>

		<?php echo $form->textFieldRow($model,'chhachis_no',array('class'=>'span5','maxlength'=>20)); ?>

		<?php echo $form->textFieldRow($model,'company',array('class'=>'span5','maxlength'=>30)); ?>

		<?php echo $form->textFieldRow($model,'registered_date',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'created_date',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'created_by',array('class'=>'span5','maxlength'=>20)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textFieldRow($model,'id',array('class'=>'span5','maxlength'=>20)); ?>

		<?php echo $form->textFieldRow($model,'busOwnerId',array('class'=>'span5','maxlength'=>20)); ?>

		<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>50)); ?>

		<?php echo $form->textFieldRow($model,'relationship',array('class'=>'span5','maxlength'=>50)); ?>

		<?php echo $form->textFieldRow($model,'mobile_no',array('class'=>'span5','maxlength'=>15)); ?>

		<?php echo $form->textFieldRow($model,'landline',array('class'=>'span5','maxlength'=>15)); ?>

		<?php echo $form->textFieldRow($model,'created_by',array('class'=>'span5','maxlength'=>20)); ?>

		<?php echo $form->textFieldRow($model,'created_date',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

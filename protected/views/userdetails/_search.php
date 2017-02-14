<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textFieldRow($model,'id',array('class'=>'span5','maxlength'=>20)); ?>

		<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>40)); ?>

		<?php echo $form->textFieldRow($model,'address',array('class'=>'span5','maxlength'=>40)); ?>

		<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>100)); ?>

		<?php echo $form->textFieldRow($model,'phone',array('class'=>'span5','maxlength'=>20)); ?>

		<?php echo $form->textFieldRow($model,'mobile',array('class'=>'span5','maxlength'=>20)); ?>

		<?php echo $form->textAreaRow($model,'academic_qualification',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

		<?php echo $form->textAreaRow($model,'professional_qualification',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

		<?php echo $form->textFieldRow($model,'enrolled_date',array('class'=>'span5')); ?>

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

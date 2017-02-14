<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textFieldRow($model,'id',array('class'=>'span5','maxlength'=>20)); ?>

		<?php echo $form->textFieldRow($model,'bus_id',array('class'=>'span5','maxlength'=>20)); ?>

		<?php echo $form->textFieldRow($model,'insurance_company',array('class'=>'span5','maxlength'=>100)); ?>

		<?php echo $form->textFieldRow($model,'insurance_account',array('class'=>'span5','maxlength'=>50)); ?>

		<?php echo $form->textFieldRow($model,'ac_holder_name',array('class'=>'span5','maxlength'=>100)); ?>

		<?php echo $form->textFieldRow($model,'tax_invoice_no',array('class'=>'span5','maxlength'=>50)); ?>

		<?php echo $form->textFieldRow($model,'police_no',array('class'=>'span5','maxlength'=>50)); ?>

		<?php echo $form->textFieldRow($model,'issue_date',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'expiry_date',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'remarks',array('class'=>'span5','maxlength'=>200)); ?>

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

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

<?php echo $form->textFieldRow($model,'id',array('class'=>'span5','maxlength'=>20)); ?>

<?php echo $form->textFieldRow($model,'fname',array('class'=>'span5','maxlength'=>50)); ?>

<?php echo $form->textFieldRow($model,'mname',array('class'=>'span5','maxlength'=>50)); ?>

<?php echo $form->textFieldRow($model,'lname',array('class'=>'span5','maxlength'=>50)); ?>

<?php echo $form->textFieldRow($model,'id_no',array('class'=>'span5','maxlength'=>30)); ?>

<?php echo $form->textFieldRow($model,'photo',array('class'=>'span5','maxlength'=>100)); ?>

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

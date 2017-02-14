<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'user-details-form',
    'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>
<div class="row-fluid">
    <div class="span4">
        <?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>40)); ?>
    </div>
    <div class="span4">
        <?php echo $form->textFieldRow($model,'address',array('class'=>'span5','maxlength'=>40)); ?>
    </div>
    <div class="span4">
        <?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>100)); ?>
    </div>
</div>
<div class="row-fluid">
    <div class="span4">
        <?php echo $form->textFieldRow($model,'phone',array('class'=>'span5','maxlength'=>20)); ?>
    </div>
    <div class="span4">
        <?php echo $form->textFieldRow($model,'mobile',array('class'=>'span5','maxlength'=>20)); ?>
    </div>
    <div class="span4">
        <!--        --><?php //echo $form->textFieldRow($model,'photo',array('class'=>'span5','maxlength'=>100)); ?>

        <?php echo $form->labelEx($model,'photo'); ?>
        <?php echo CHtml::activeFileField($model, 'photo',array('class'=>'span20')); ?>
        <?php if($model->isNewRecord!='1'){ ?>
            <?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/UserPhoto/'.$model->id.'/'.$model->photo,"photo",array("width"=>200)); ?>
        <?php } ?>
        <?php echo $form->error($model,'photo'); ?>
    </div>
</div>
<div class="row-fluid">
    <div class="span4">
        <?php echo $form->textAreaRow($model,'academic_qualification',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
    </div>
    <div class="span4">
        <?php echo $form->textAreaRow($model,'professional_qualification',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
    </div>
    <div class="span4">
        <?php echo $form->textFieldRow($model,'enrolled_date',array('class'=>'span5','maxlength'=>20, 'id'=>'enrolled_date')); ?>
    </div>
</div>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'submit',
        'type'=>'primary',
        'label'=>$model->isNewRecord ? 'Submit Form' : 'Save',
    )); ?>
</div>

<?php $this->endWidget(); ?>
<script>
    $('#enrolled_date').calendarsPicker({calendar: $.calendars.instance('nepali'), dateFormat: 'yyyy-mm-dd'});
</script>
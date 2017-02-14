<style>
    #BusOwner_nationality{
        width: 40.17094017094017%;
    }
</style>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'bus-owner-form',
    'enableAjaxValidation'=>true,
    'focus'=>array($model,'fname'),
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data'
    ),
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary(array($model, $busOwnAttach, $tempAddress, $busOwnContact, $busOwnEmContact)); ?>
<div class="row-fluid">
    <div class="span4">
        <?php echo $form->textFieldRow($model,'fname',array('class'=>'span5','maxlength'=>50, 'required'=>true, 'pattern'=>'[a-zA-Z\s]+')); ?>
    </div>
    <div class="span4">
        <?php echo $form->textFieldRow($model,'mname',array('class'=>'span5','maxlength'=>50,  'pattern'=>'[a-zA-Z\s]+')); ?>
    </div>
    <div class="span4">
        <?php echo $form->textFieldRow($model,'lname',array('class'=>'span5','maxlength'=>50, 'required'=>true, 'pattern'=>'[a-zA-Z\s]+')); ?>
    </div>
</div>
<div class="row-fluid">
    <div class="span4">
        <?php echo $form->dropDownListRow($model,'gender',array('male'=>'Male', 'female'=>'Female', 'others'=>'Others'), array('class'=>'span5','maxlength'=>50)); ?>
    </div>
    <div class="span4">
        <?php echo $form->dropDownListRow($model,'marital_status', array('single'=>'Single', 'married'=>'Married', 'divorced'=>'Divorced'), array('class'=>'span5','maxlength'=>50)); ?>
    </div>

    <div class="span4">
        <?php //echo $form->dropDownListRow($model,'nationality',array('class'=>'span5','maxlength'=>50)); ?>
        <!--<br/>-->
        <?php echo $form->labelEx($model,'nationality'); ?>
        <?php $this->widget('ext.CountrySelectorWidget', array(
            'value' => $model->nationality,
            'name' => Chtml::activeName($model, 'nationality'),
            'id' => Chtml::activeId($model, 'nationality'),
            'useCountryCode' => false,
            'defaultValue' => 'Nepal',
            'firstEmpty' => false,
        ));?>
    </div>
</div>
<div class="row-fluid">
    <div class="span4">
        <?php echo $form->textFieldRow($model,'date_of_birth',array('id'=>'dob', 'class'=>'span5','maxlength'=>30)); ?>
    </div>

    <div class="span4">
        <?php echo $form->textFieldRow($model,'id_no',array('class'=>'span5','maxlength'=>30)); ?>
    </div>
    <div class="span4">
        <?php echo $form->fileFieldRow($model,'photo',array('class'=>'span5','maxlength'=>100)); ?>
        <?php if($model->isNewRecord!='1'){ ?>
            <?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/BusOwner/'. $model->id . '/' . $model->photo,"photo",array("width"=>200)); ?>
        <?php } ?>

    </div>
</div>
<div class="row-fluid">
    <div class="span12">
        <h3>Attachments</h3>
        <div class="row-fluid">
            <div class="span4">
                <?php echo $form->labelEx($busOwnAttach, 'image');?>
                <?php
                $this->widget('CMultiFileUpload', array(
                    'model'=>$busOwnAttach,
                    'attribute'=>'image',
                    'accept'=>'jpg|gif|png|dcm|dicom',
                    'name' => 'img',
                    'denied'=>'File is not allowed',
                    'max'=>10, // max 10 files
//    'options'=>array('class'=>'span2')
                    /*'options'=>array(
                        'onFileSelect'=>'function(e, v, m){ alert("onFileSelect - "+v) }',
                        'afterFileSelect'=>'function(e, v, m){ alert("afterFileSelect - "+v) }',
                        'onFileAppend'=>'function(e, v, m){ alert("onFileAppend - "+v) }',
                        'afterFileAppend'=>'function(e, v, m){ alert("afterFileAppend - "+v) }',
                        'onFileRemove'=>'function(e, v, m){ alert("onFileRemove - "+v) }',
                        'afterFileRemove'=>'function(e, v, m){ alert("afterFileRemove - "+v) }',
                    )*/
                ));
                echo $form->error($busOwnAttach,'image');
                ?>
            </div>
            <div class="span7">
                <?php echo $form->textAreaRow($busOwnAttach,'description',array('class'=>'span10','maxlength'=>200)); ?>
            </div>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span12">
            <h3>Temporary Address</h3>
            <div class="row-fluid">

                <div class="span4">
                    <?php //echo CHtml::link('Show/hide Temporary Address','',array('id'=>'optional-link')); ?>
                    <?php echo $form->labelEx($tempAddress,'zone'); ?>
                    <?php  echo $form->dropDownList($tempAddress,'zone',CHtml::listData(Zone::model()->findAll(
                            array('order' => 'zone_name')),'id','zone_name'),
                        array(
                            'prompt'=>'Select Zone',
                            'class'=>'span5',
                            'ajax' => array(
                                'type'=>'POST',
                                'url'=>Yii::app()->createUrl('BusOwner/LoadDistrict'),
                                'update'=>'#' . CHtml::activeId($tempAddress, 'district'),
                                'data'=>array('id'=>'js:this.value'),
                            )));
                    ?>
                    <?php echo $form->error($tempAddress,'zone'); ?>
                </div>
                <div class="span4">
                    <?php echo $form->labelEx($tempAddress,'district'); ?>
                    <?php  echo $form->dropDownList($tempAddress,'district', array(), array('prompt'=>'First Select Zone','class'=>'span5')); ?>
                    <?php echo $form->error($tempAddress,'district'); ?>
                </div>
                <div class="span4">
                    <?php echo $form->textFieldRow($tempAddress,'vdc_municipality',array('class'=>'span5','maxlength'=>50)); ?>
                </div>
            </div>
            <div class="row-fluid">

                <div class="span4">
                    <?php echo $form->textFieldRow($tempAddress,'ward',array('class'=>'span5')); ?>
                </div>
                <div class="span4">
                    <?php echo $form->textFieldRow($tempAddress,'tole',array('class'=>'span5','maxlength'=>50)); ?>
                </div>
                <div class="span4">
                    <?php echo $form->textFieldRow($tempAddress,'house_no',array('class'=>'span5','maxlength'=>20)); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row-fluid">
        <div class="span12">
            <h3>Permanent Address</h3>
            <div class="row-fluid">
                <div class="span4">
                    <?php echo $form->labelEx($model,'per_zone'); ?>
                    <?php  echo $form->dropDownList($model,'per_zone',CHtml::listData(Zone::model()->findAll(
                            array('order' => 'zone_name')),'id','zone_name'),
                        array(
                            'prompt'=>'Select Zone',
                            'class'=>'span5',
                            'ajax' => array(
                                'type'=>'POST',
                                'url'=>Yii::app()->createUrl('BusOwner/LoadDistrict'), //or $this->createUrl('loadcities') if '$this' extends CController
                                'update'=>'#' . CHtml::activeId($model, 'per_district'),
                                'data'=>array('id'=>'js:this.value'),
                            )));
                    ?>
                    <?php echo $form->error($model,'per_zone'); ?>
                    <!--    --><?php //echo $form->textFieldRow($perAddress,'zone',array('class'=>'span5','maxlength'=>20)); ?>
                </div>
                <div class="span4">
                    <?php echo $form->labelEx($model,'per_district'); ?>
                    <?php  echo $form->dropDownList($model,'per_district', array(), array('prompt'=>'First Select Zone','class'=>'span5'));?>
                    <?php echo $form->error($model,'per_district'); ?>
                    <!--    --><?php //echo $form->textFieldRow($perAddress,'district',array('class'=>'span5','maxlength'=>20)); ?>
                </div>
                <div class="span4">
                    <?php echo $form->textFieldRow($model,'per_vdc_municipality',array('class'=>'span5','maxlength'=>50)); ?>
                </div>
            </div>

            <div class="row-fluid">
                <div class="span4">
                    <?php echo $form->textFieldRow($model,'per_ward',array('class'=>'span5')); ?>
                </div>
                <div class="span4">
                    <?php echo $form->textFieldRow($model,'per_tole',array('class'=>'span5','maxlength'=>50)); ?>
                </div>
                <div class="span4">
                    <?php echo $form->textFieldRow($model,'per_house_no',array('class'=>'span5','maxlength'=>20)); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row-fluid">
        <div class="span12">
            <h3>Bus Owner Contact Information</h3>
            <div class="row-fluid">
                <div class="span6">
                    <?php echo $form->textFieldRow($busOwnContact,'mobile',array('class'=>'span5','maxlength'=>15)); ?>
                </div>
                <div class="span6">
                    <?php echo $form->textFieldRow($busOwnContact,'landline',array('class'=>'span5','maxlength'=>15)); ?>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span6">
                    <?php echo $form->textFieldRow($busOwnContact,'email',array('class'=>'span5','maxlength'=>50)); ?>
                </div>
                <div class="span6">
                    <?php echo $form->textFieldRow($busOwnContact,'workPhone',array('class'=>'span5','maxlength'=>15)); ?>
                </div>
            </div>
        </div>
        <div class="row-fluid">

            <div class="span12">

                <h3 >Bus Owner Emergency Contact</h3>
                <div class="row-fluid">
                    <div class="span6">
                        <?php echo $form->textFieldRow($busOwnEmContact,'name',array('class'=>'span5','maxlength'=>50)); ?>
                    </div>
                    <div class="span6">
                        <?php echo $form->textFieldRow($busOwnEmContact,'relationship',array('class'=>'span5','maxlength'=>50)); ?>
                    </div>
                </div>

                <div class="row-fluid">
                    <div class="span6">
                        <?php echo $form->textFieldRow($busOwnEmContact,'mobile_no',array('class'=>'span5','maxlength'=>15)); ?>
                    </div>
                    <div class="span6">
                        <?php echo $form->textFieldRow($busOwnEmContact,'landline',array('class'=>'span5','maxlength'=>15)); ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>$model->isNewRecord ? 'Create' : 'Save',
        )); ?>
    </div>

    <?php $this->endWidget(); ?>

    <script>
        $('#dob').calendarsPicker({calendar: $.calendars.instance('nepali'), dateFormat: 'yyyy-mm-dd'});
    </script>
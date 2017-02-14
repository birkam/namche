<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'driver-info-form',
    'enableAjaxValidation'=>true,
    'enableClientValidation' => true,
    'clientOptions'=>array('validateOnSubmit'=>true), //This is very important
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>
<div class="well">
    <h2>Basic Information</h2>
    <div class="row-fluid">
        <div class="span4">
            <?php echo $form->textFieldRow($model,'fname',array('class'=>'span8','maxlength'=>20)); ?>
        </div>
        <div class="span4">
            <?php echo $form->textFieldRow($model,'mname',array('class'=>'span8','maxlength'=>20)); ?>
        </div>
        <div class="span4">
            <?php echo $form->textFieldRow($model,'lname',array('class'=>'span8','maxlength'=>20)); ?>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span4">
            <?php echo $form->fileFieldRow($model,'photo',array('class'=>'span8','maxlength'=>100)); ?>
        </div>
        <div class="span4">
            <?php echo $form->textFieldRow($model,'address',array('class'=>'span8','maxlength'=>50)); ?>
        </div>
        <div class="span4">
            <?php echo $form->dropDownListRow($model,'gender',array('male'=>'Male', 'female'=>'Female', 'others'=>'Others'), array('class'=>'span8','maxlength'=>10)); ?>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span4">
            <?php echo $form->textFieldRow($model,'date_of_birth',array('class'=>'span8','maxlength'=>10, 'id'=>'dob')); ?>
        </div>
        <div class="span4">
            <?php echo $form->textFieldRow($model,'mobile',array('class'=>'span8','maxlength'=>20)); ?>
        </div>
        <div class="span4">
            <?php echo $form->textFieldRow($model,'landline',array('class'=>'span8','maxlength'=>20)); ?>
        </div>
    </div>
</div>
<div class="well">
    <h2>Emergency Contact</h2>
    <div class="row-fluid">
        <div class="span4">
            <?php echo $form->textFieldRow($model,'em_contact_name',array('class'=>'span8','maxlength'=>40)); ?>
        </div>
        <div class="span4">
            <?php echo $form->textFieldRow($model,'em_contact_relation',array('class'=>'span8','maxlength'=>40)); ?>
        </div>
        <div class="span4">
            <?php echo $form->textFieldRow($model,'em_contact_number',array('class'=>'span8','maxlength'=>20)); ?>
        </div>
    </div>
</div>
<div class="well">
    <h2>Licence Information</h2>
    <div class="row-fluid">
        <div class="span4">
            <?php echo $form->textFieldRow($model,'licence_no',array('class'=>'span8','maxlength'=>50)); ?>
        </div>
        <div class="span4">
            <?php echo $form->textFieldRow($model,'licence_issue_date',array('class'=>'span8','maxlength'=>10, 'id'=>'lid', 'placeholder'=>'yyyy-mm-dd')); ?>
        </div>
        <div class="span4">
            <?php echo $form->textFieldRow($model,'licence_exp_date',array('class'=>'span8','maxlength'=>10, 'id'=>'led', 'placeholder'=>'yyyy-mm-dd')); ?>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span4">
            <?php echo $form->textFieldRow($model,'citizenship_no',array('class'=>'span8','maxlength'=>50)); ?>
        </div>
        <div class="span4">
            <?php echo $form->dropDownListRow($model,'blood_group', array('O−'=>'O−',	'O+'=>'O+',	'A−'=>'A−', 'A+'=>'A+', 'B−'=>'B−','B+'=>'B+','AB−'=>'AB−', 'AB+'=>'AB+'),array('prompt'=>'--Choose One--','class'=>'span8','maxlength'=>20)); ?>
        </div>
    </div>
    <div class="row">
        <div class="span4">
            <?php echo $form->labelEx($model,'licence_authorized_drive',array()); ?>
        </div><br>
        <?php
        $vehicles = Vehicles::model()->findAll();
        $vehiclesArr = array();
        foreach($vehicles as $vehicle){
            $vehiclesArr[$vehicle->id] = ucwords($vehicle->category.'. '.strtolower($vehicle->vehicles));
            ?>
            <div class="span3 banner banner1">
                <div id="<?php echo $vehicle->id?>">
                    <input type="checkbox" name="checkBoxList[]" class="check"  id="chb[]" value = '<?php echo $vehicle->id?>'><?php echo ucwords($vehicle->category.'. '.strtolower($vehicle->vehicles));;?>
                </div>
            </div>
        <?php
        }

        ?>
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
        $('#dob, #lid, #led').calendarsPicker({calendar: $.calendars.instance('nepali'), dateFormat: 'yyyy-mm-dd'});
        //    $('#defaultPopup,#defaultInline').calendarsPicker({calendar: $.calendars.instance('nepali')});
        $('#driver-info-form').submit(function(){
            if(!$('#driver-info-form input[type="checkbox"]').is(':checked')){
                alert("Please check at least one checkbox!");
                return false;
            }
        });
    </script>
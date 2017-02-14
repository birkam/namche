<style>
    #sk{
        margin-left:17px;
    }
</style>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'bus-and-driver-form',
    'enableAjaxValidation'=>false,
)); ?>

<?php


?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>
<?php
$driversInfo_arr = array();
$driversInfo = DriverInfo::model()->findAll();
foreach($driversInfo as $driver){
    $driversInfo_arr[$driver->id]=ucwords(strtolower($driver->fname.' '.$driver->mname.' '.$driver->lname.', '.$driver->licence_no));
}
?>
<?php echo $form->labelEx($model, 'driver_id');?>
<?php
$this->widget('ext.yii-selectize.YiiSelectize', array(
    'model' => $model,
    'attribute' => 'driver_id',
    'data' => $driversInfo_arr,
    'fullWidth' => false,
    'placeholder' => 'Type Here To Search!',
));
?>
<!--	--><?php //echo $form->textFieldRow($model,'driver_id',array('class'=>'span5','maxlength'=>20)); ?>

<!--	--><?php //echo $form->textFieldRow($model,'driver_status',array('class'=>'span5')); ?>

<?php echo $form->textFieldRow($model,'driver_entered_date',array('class'=>'span2','maxlength'=>10, 'id'=>'entered_date')); ?>

<!--	--><?php //echo $form->textFieldRow($model,'driver_left_date',array('class'=>'span5','maxlength'=>10)); ?>


<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'submit',
        'type'=>'primary',
        'label'=>$model->isNewRecord ? 'Create' : 'Save',
    )); ?>
    <!--    --><?php //echo CHtml::submitButton(
    //        'Skip',
    //            array(
    //                'submit' => Yii::app()->request->baseUrl.'/CheckedCostConfiguration/Create/'.$bus_id,
    //                'style' => 'width: 90px; height: 32px; border-radius: 4px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #ffffff; text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25); border-color:rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25); background-image:linear-gradient(to bottom, #0088cc, #0044cc);',
    //        )); ?>
</div>
<?php $this->endWidget(); ?>

<input type="submit" value="Skip" id="sk" style = 'width: 90px; height: 32px; border-radius: 4px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #ffffff; text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25); border-color:rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25); background-image:linear-gradient(to bottom, #0088cc, #0044cc);'>

<script>
    $('#entered_date').calendarsPicker({calendar: $.calendars.instance('nepali'), dateFormat: 'yyyy-mm-dd'});
    $(document).ready(function(){
        $('#sk').live("click", function() {
            var thisBusDriver = "<?php echo $driverName;?>";
            if(thisBusDriver == ''){
                if (confirm('This bus has no driver!! Are you sure you want to skip??')) {
                    window.location='<?php echo Yii::app()->request->baseUrl; ?>/CheckedCostConfiguration/Create?<?php echo 'id='.$bus_id.'&rid='.$rid.'&dbq_id='.$dbq_id.'&tid='.$_GET['tid'];?>';
                } else {
                    return false;
                }
/*                alert('This bus has no driver!! Please Assign Driver First!!');
                return false;*/
            }
            else{
                window.location='<?php echo Yii::app()->request->baseUrl; ?>/CheckedCostConfiguration/Create?<?php echo 'id='.$bus_id.'&rid='.$rid.'&dbq_id='.$dbq_id.'&tid='.$_GET['tid'];?>';
            }
        });
    });
</script>

<?php
/**
 * Created by PhpStorm.
 * User: Hero
 * Date: 3/20/2017
 * Time: 11:28 PM
 */
?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'bus-replace-from-queue-form',
//    'enableClientValidation'=>true,
//    'clientOptions'=>array(
//        'validateOnSubmit'=>true,
//    ),
)); ?>

<div class="modal-body">
    <br>
    <?php echo $form->hiddenField($replaceModel,'replace_old_bus_id', array('value'=>$old_bus->id)); ?>
    <?php echo $form->hiddenField($replaceModel,'dbq_id', array('value'=>$dbq_id)); ?>
    <?php echo $form->hiddenField($replaceModel,'dqb_id', array('value'=>$dqb_id)); ?>
    <label>Replace Type</label>
    <?= $form->dropDownList($replaceModel,'replace_type',[1=>'Temporary', 2=>'Permanent'], ['prompt'=>'Select One','required'=>true]);?>
    <label>Replace "<?= $old_bus->bus_no; ?>"<span style="font-weight: bolder;font-size: 14px; text-transform: uppercase;" id="old_bus"></span> With: </label>
    <?php
    $this->widget('ext.yii-selectize.YiiSelectize', array(
        'model' => $replaceModel,
        'attribute' => 'replace_new_bus_id',
        'data' => CHtml::listData($bus_replace, 'bus_id', 'bus_no'),
        'fullWidth' => false,
        'placeholder' => 'Type Here To Search!',
        'htmlOptions'=>['required'=>true]
    ));
    ?>
    <label>Remarks</label>
    <?php echo $form->textArea($replaceModel,'remarks',['required'=>true]); ?>
</div>
<div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <?php echo CHtml::button('Save', array('class'=>'btn', 'id'=>'bus-replace-from-queue-save')); ?>
</div>
<?php $this->endWidget(); ?>
<script>
    $( document ).ready(function () {
        $('#bus-replace-from-queue-save').on('click', function () {
            var form = $('#bus-replace-from-queue-form');
            var check_valid = form[0].checkValidity();
            if(check_valid){
                $.ajax({
                    type: "POST",
                    url: "<?php echo Yii::app()->request->baseUrl; ?>/dailybusqueue/replacesave",
                    data: form.serialize(),
                    success: function (response) {
                        alert(response);
                        if(response==1){
                            location.reload();
                        }
                        else {
                            alert('something went wrong during removing');
                        }
                    }
                });
            }
            else{

            }
        })
    });
</script>
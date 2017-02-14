<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'bus-insurance-form',
    'enableAjaxValidation'=>true,
)); ?>
<?php

?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<div class="well">
    <div class="row-fluid">
        <div class="span4">
            <?php echo $form->textFieldRow($model,'insurance_company',array('class'=>'span8','maxlength'=>100)); ?>
        </div>
        <div class="span4">

            <?php echo $form->textFieldRow($model,'insurance_account',array('class'=>'span8','maxlength'=>50)); ?>
        </div>
        <div class="span4">
            <?php echo $form->textFieldRow($model,'ac_holder_name',array('class'=>'span8','maxlength'=>100)); ?>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span4">
            <?php echo $form->textFieldRow($model,'tax_invoice_no',array('class'=>'span8','maxlength'=>50)); ?>
        </div>
        <div class="span4">
            <?php echo $form->textFieldRow($model,'police_no',array('class'=>'span8','maxlength'=>50)); ?>
        </div>
        <div class="span4">
            <?php echo $form->textFieldRow($model,'insured_amount',array('class'=>'span8','maxlength'=>13)); ?>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span4">
            <?php echo $form->textFieldRow($model,'agent_code',array('class'=>'span8','maxlength'=>50)); ?>
        </div>
        <div class="span4">
            <?php echo $form->labelEx($model,'issue_date'); ?>
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                    'model'=>$model,
                    'attribute'=>'issue_date',
                    'id' =>'issue_date',
                    'name'=>'issue_date',
                    'options' => array(
                        'mode'=>'focus',
                        'dateFormat'=>'yy-mm-dd',
                        'showAnim' => 'slideDown',
                        'changeMonth'=>true,
                        'changeYear'=>true,
                        'changeDay'=>true,
//            'yearRange'=>'1900:2100',
                    ),
                    'htmlOptions'=>array(
                        'size'=>25,
                        'class'=>'date span8',
                        //                      'value'=>date('Y-m-d')
                        'placeholder'=>'yyyy-mm-dd'
                    ),
                )
            );?>
            <?php echo $form->error($model,'issue_date'); ?>
        </div>
        <div class="span4">
            <?php echo $form->labelEx($model,'expiry_date'); ?>
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                    'model'=>$model,
                    'attribute'=>'expiry_date',
                    'id' =>'expiry_date',
                    'name'=>'expiry_date',
                    'options' => array(
                        'mode'=>'focus',
                        'dateFormat'=>'yy-mm-dd',
                        'showAnim' => 'slideDown',
                        'changeMonth'=>true,
                        'changeYear'=>true,
                        'changeDay'=>true,
//            'yearRange'=>'1900:2100',
                    ),
                    'htmlOptions'=>array(
                        'size'=>25,
                        'class'=>'date span8',
                        'placeholder'=>'yyyy-mm-dd'
//                        'value'=>date('Y-m-d')
                    ),
                )
            );?>
            <?php echo $form->error($model,'expiry_date'); ?>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span4">
            <?php echo $form->textFieldRow($model,'remarks',array('class'=>'span8','maxlength'=>200)); ?>
        </div>
    </div>
</div>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'submit',
        'id'=>'submit',
        'type'=>'primary',
        'label'=>$model->isNewRecord ? 'Create' : 'Save',
    )); ?>
</div>

<?php $this->endWidget(); ?>
<script>
    $(document).ready(function(){
        $('#submit').live("click", function() {
            var issue_date = $('#issue_date').val();
            var expiry_date = $('#expiry_date').val();
            if(issue_date >= expiry_date){
                alert('Expiry Date('+expiry_date+ ') must be later than Issue Date ('+issue_date+')');
                return false;
            }
        });
//        $(function() {
//            $('#issue_date').change(function () {
//                var htmldate = new Date($(this).val());
//                var convDate = (htmldate.getMonth() + 1) + '-' + htmldate.getDate() + '-' +  htmldate.getFullYear();
////                alert(convDate);
//                var parts = convDate.split('-');
//                var date = new Date(parseInt(parts[2], 10), parseInt(parts[0], 10) - 1, parseInt(parts[1], 10) );
//                date.setFullYear(date.getFullYear() + 1);
//
//                $('#expiry_date').val(isNaN(date.getFullYear()) ? '' : formatDate(date));
////                alert(date);
//            });
//        });
//        function formatDate(date) {
//            var day = date.getDate();
//            var month = date.getMonth() + 1;
//            var year = date.getFullYear();
//            return year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
//        }
    });
</script>
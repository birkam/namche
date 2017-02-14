<div class="form">
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
        'id'=>'bus-inside-route-form',
        'enableAjaxValidation'=>true,
    )); ?>
    <?php
    $busInRoute_arr = array();
    $busInRoute = BusInsideRoute::model()->findAllByAttributes(array('bus_status'=>1));
    if(!empty($busInRoute)){
        foreach($busInRoute as $f_a_b){
            $busInRoute_arr[]=$f_a_b->bus_id;
        }
    }
    $already_selected_bus = array_keys(array_count_values($busInRoute_arr));

    $bus = Bus::model()->findAll();
    $arrayAllBus = array();
    foreach($bus as $b){
        $arrayAllBus[] = $b->id;
    }
    $all_bus = array_keys(array_count_values($arrayAllBus));
    $not_selected_bus = array_diff($all_bus,$already_selected_bus);

    $not_selected_all = Bus::model()->findAllByAttributes(array('id'=>$not_selected_bus));
    $arrayNotSelected = array();
    foreach($not_selected_all as $b){
        $arrayNotSelected[$b->id] = $b->bus_no;
    }
    ?>
    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php //echo $form->dropDownListRow($model,'bus_id', $arrayNotSelected, array('prompt'=>'--Choose One--', 'class'=>'span5','maxlength'=>20)); ?>
    <div class="row">
        <div class="span5" style="margin-left: 0px">
            <?php echo $form->labelEx($model,'bus_id');?>
            <?php
            $this->widget('ext.yii-selectize.YiiSelectize', array(
                'model' => $model,
                'attribute' => 'bus_id',
                'data' => $arrayNotSelected,
//            'fullWidth' => false,
                'placeholder' => 'Type Here To Search!',
            ));
            ?>
            <?php echo $form->error($model,'bus_id');?>
        </div>
    </div>
    <div class="row">
        <?php echo $form->textFieldRow($model,'bus_assigned_date',array('class'=>'span5','maxlength'=>10,'id'=>'as_date')); ?>
    </div>
    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>$model->isNewRecord ? 'Create' : 'Save',
        )); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
<script>
    $('#as_date').calendarsPicker({calendar: $.calendars.instance('nepali'), dateFormat: 'yyyy-mm-dd'});
</script>

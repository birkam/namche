<?php
$this->breadcrumbs=array(
	'Fileno Buses'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List FilenoBus','url'=>array('index')),
array('label'=>'Create FilenoBus','url'=>array('create')),
array('label'=>'Update FilenoBus','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete FilenoBus','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage FilenoBus','url'=>array('admin')),
);
//$bus = Bus::model()->findByPk($model->bus_id);
$fileNo = FileNo::model()->findByPk($model->fileno_id);
$user = UserAccount::model()->findByPk($model->created_by);
if($model->owner_type == '1'){
    $type = 'Primary';
}elseif($model->owner_type == '2'){
    $type = 'Secondary';
}else{
    $type = '';
}
?>

<div class="title"> <h5>View Bus Owner Under File Number ::<?php echo $fileNo->file_no; ?>::</h5></div>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
    'data'=>$model,
    'attributes'=>array(
//        'id',
//        'fileno_id',
        array(
            'name' => 'File No',
            'value' =>$fileNo->file_no,
        ),
        array(
            'name' => 'owner_type',
            'value' =>$type,
        ),
//        'owner_id',
        array('label'=>$model->fnb->getAttributeLabel('owner_id'),
            'value'=>ucwords(strtolower($model->fnb->fname.' '.$model->fnb->mname.' '.$model->fnb->lname))),
//        'owner_status',
        array('name'=>'owner_status', 'value'=>FilenoBus::$status[$model->owner_status]),
        'owned_date',
        'left_date',
        array('label'=>$model->user->getAttributeLabel('created_by'),
            'value'=>strtolower($model->user->user_name)),
        'created_date',
    ),
)); ?>


<?php if($model->owner_status == 1){?>
    <?php Yii::app()->clientScript->registerScript('toggler','$("#clickme").bind("click",function(){$("#show_hide").toggle();})')?>
    <h3>If owner wants to leave ownership, <a id="clickme">Click here!</a></h3>
    <div style="display: none" id="show_hide">
        <form method="POST" action="<?php echo Yii::app()->request->baseUrl; ?>/FilenoBus/Deactivate">
            <input type="hidden" name="id" value="<?php echo $model->id;?>">
            <input type="text" id="left_date" required="true" name="left_date" placeholder="yyyy-mm-dd" readonly>

            <input type="submit" name="submit" class = 'btn btn-primary' id="submit">
        </form>
    </div>
<?php }?>

<?php //if($model->owner_status == 0){?>
<!--    <a href="--><?php //echo Yii::app()->controller->createUrl("/FilenoBus/Activate",array("id"=>$model->id))?><!--">-->
<!--        <input type="button" value="Activate" class = 'btn btn-primary' >-->
<!--    </a>-->
<?php //}?>
<script>
    $('#left_date').calendarsPicker({calendar: $.calendars.instance('nepali'), dateFormat: 'yyyy-mm-dd'});

    $(document).ready(function(){
        $('#submit').live("click", function() {
            var owned_date = '<?php echo $model->owned_date;?>';
            var left_date = $('#left_date').val();
            if(owned_date >= left_date){
            alert('Left Date('+left_date+ ') must be later than owned date ('+owned_date+')');
                return false;
            }
        });
    });

</script>

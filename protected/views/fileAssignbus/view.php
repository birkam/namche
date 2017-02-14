<?php
$this->breadcrumbs=array(
    'File Assignbuses'=>array('index'),
    $model->id,
);

$this->menu=array(
    array('label'=>'List FileAssignbus','url'=>array('index')),
    array('label'=>'Create FileAssignbus','url'=>array('create')),
    array('label'=>'Update FileAssignbus','url'=>array('update','id'=>$model->id)),
    array('label'=>'Delete FileAssignbus','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('label'=>'Manage FileAssignbus','url'=>array('admin')),
);
?>
<?php
$this->widget('bootstrap.widgets.TbAlert', array(
    'fade' => true,
    'closeText' => '&times;', // false equals no close link
    'events' => array(),
    'htmlOptions' => array(),
    'userComponentId' => 'user',
    'alerts' => array( // configurations per alert type
        // success, info, warning, error or danger
        'success' => array('closeText' => '&times;'),
        'info', // you don't need to specify full config
        'warning' => array('closeText' => false),
        'error' => array('closeText' => '')
    ),
));
$bus = Bus::model()->findByPk($model->bus_id);
if(!empty($bus)){$bus_no = $bus->bus_no;}else{$bus_no = 'Could Not Find';}
$fileNo = FileNo::model()->findByPk($model->fileno_id);
if($model->bus_status == 1){
    $bus_stat = 'Active';
}elseif($model->bus_status == 0){
    $bus_stat = 'No Active';
}
$user = UserAccount::model()->findByPk($model->created_by);

?>
<h1>View Bus Inside File Number "<?php echo $fileNo->file_no; ?>"</h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
    'data'=>$model,
    'attributes'=>array(
//        'id',
//        'fileno_id',
        array(
            'name' => 'Bus No',
            'value' =>$bus_no,
        ),
        array(
            'name' => 'File No',
            'value' =>$fileNo->file_no,
        ),
//        'bus_status',
        array(
            'name' => 'Bus Status',
            'value' =>$bus_stat,
        ),
        'bus_entered_date',
        'taken_out_date',
//        'created_by',
        array(
            'name' => 'Created By',
            'value' =>$user->user_name,
        ),
        'created_date',

    ),
)); ?>

<?php if($model->bus_status == 1){?>
<?php Yii::app()->clientScript->registerScript('toggler','$("#clickme").bind("click",function(){$("#show_hide").toggle();})')?>
<h3>To Remove, <a id="clickme">Click here!</a></h3>
<div style="display: none" id="show_hide">
    <form action="<?php echo Yii::app()->request->baseUrl; ?>/FileAssignbus/Remove" method="POST">
        <input type="hidden" name="id" value="<?php echo $model->id;?>">
        <input type="text" name="taken_out_date" id="taken_out_date" max="10" placeholder="yyyy-mm-dd" readonly>
        <input type="submit" name="submit" value="Remove" class = 'btn btn-primary' id="submit">
    </form>
</div>
<?php }?>
<script>
    $('#taken_out_date').calendarsPicker({calendar: $.calendars.instance('nepali'), dateFormat: 'yyyy-mm-dd'});

    $(document).ready(function(){
        $('#submit').live("click", function() {
            var bus_entered_date = '<?php echo $model->bus_entered_date;?>';
            var taken_out_date = $('#taken_out_date').val();
            if(bus_entered_date >= taken_out_date){
                alert('Taken Out Date (' +taken_out_date+ ') must be later than Entered Date ('+ bus_entered_date +' )');
                return false;
            }
        });
    });
</script>
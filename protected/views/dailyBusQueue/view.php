<?php
$this->breadcrumbs=array(
    'Daily Bus Queues'=>array('index'),
    $model->id,
);

$this->menu=array(
    array('label'=>'List DailyBusQueue','url'=>array('index')),
    array('label'=>'Create DailyBusQueue','url'=>array('create')),
    array('label'=>'Update DailyBusQueue','url'=>array('update','id'=>$model->id)),
    array('label'=>'Delete DailyBusQueue','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('label'=>'Manage DailyBusQueue','url'=>array('admin')),
);
?>
<h1>View DailyBusQueue #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
    'data'=>$model,
    'attributes'=>array(
        'id',
        'route_id',
        'queue_date',
        'time_id',
        'bus_id',
        'queue_serial',
        'bus_status',
        'created_by',
        'created_date',
    ),
)); ?>

<?php
$this->breadcrumbs=array(
	'Bus And Drivers'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List BusAndDriver','url'=>array('index')),
array('label'=>'Create BusAndDriver','url'=>array('create')),
array('label'=>'Update BusAndDriver','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete BusAndDriver','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage BusAndDriver','url'=>array('admin')),
);
?>

<div class="title"><h5>View Bus and Drivers<?php echo $model->id; ?></h5></div>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'bus_id',
		'driver_id',
		'driver_status',
		'driver_entered_date',
		'driver_left_date',
		'created_by',
		'created_date',
),
)); ?>

<?php
$this->breadcrumbs=array(
	'Bus Inside Routes'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List BusInsideRoute','url'=>array('index')),
array('label'=>'Create BusInsideRoute','url'=>array('create')),
array('label'=>'Update BusInsideRoute','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete BusInsideRoute','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage BusInsideRoute','url'=>array('admin')),
);
?>

<h1>View BusInsideRoute #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'route_id',
		'bus_id',
		'bus_status',
		'bus_assigned_date',
		'bus_out_date',
		'created_by',
		'created_date',
),
)); ?>

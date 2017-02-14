<?php
$this->breadcrumbs=array(
	'Route Times'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List RouteTime','url'=>array('index')),
array('label'=>'Create RouteTime','url'=>array('create')),
array('label'=>'Update RouteTime','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete RouteTime','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage RouteTime','url'=>array('admin')),
);
?>

<h1>View RouteTime #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'route_id',
		'route_time',
		'created_by',
		'created_date',
),
)); ?>

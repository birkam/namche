<?php
$this->breadcrumbs=array(
	'Bus Removed Frm Queues'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List BusRemovedFrmQueue','url'=>array('index')),
array('label'=>'Create BusRemovedFrmQueue','url'=>array('create')),
array('label'=>'Update BusRemovedFrmQueue','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete BusRemovedFrmQueue','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage BusRemovedFrmQueue','url'=>array('admin')),
);
?>

<h1>View BusRemovedFrmQueue #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'route_id',
		'bus_id',
		'queue_date',
		'created_date',
),
)); ?>

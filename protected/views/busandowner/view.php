<?php
$this->breadcrumbs=array(
	'Bus And Owners'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List BusAndOwner','url'=>array('index')),
array('label'=>'Create BusAndOwner','url'=>array('create')),
array('label'=>'Update BusAndOwner','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete BusAndOwner','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage BusAndOwner','url'=>array('admin')),
);
?>

<h1>View BusAndOwner #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'bus_id',
		'owner_id',
		'owner_status',
		'owner_date',
		'left_date',
		'created_by',
		'created_date',
),
)); ?>

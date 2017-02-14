<?php
$this->breadcrumbs=array(
	'Bus Owner Contacts'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List BusOwnerContact','url'=>array('index')),
array('label'=>'Create BusOwnerContact','url'=>array('create')),
array('label'=>'Update BusOwnerContact','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete BusOwnerContact','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage BusOwnerContact','url'=>array('admin')),
);
?>

<h1>View BusOwnerContact #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'busOwnerId',
		'mobile',
		'landline',
		'email',
		'workPhone',
		'created_by',
		'created_date',
),
)); ?>

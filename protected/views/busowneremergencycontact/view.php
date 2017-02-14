<?php
$this->breadcrumbs=array(
	'Bus Owner Emergency Contacts'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List BusOwnerEmergencyContact','url'=>array('index')),
array('label'=>'Create BusOwnerEmergencyContact','url'=>array('create')),
array('label'=>'Update BusOwnerEmergencyContact','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete BusOwnerEmergencyContact','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage BusOwnerEmergencyContact','url'=>array('admin')),
);
?>

<h1>View BusOwnerEmergencyContact #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'busOwnerId',
		'name',
		'relationship',
		'mobile_no',
		'landline',
		'created_by',
		'created_date',
),
)); ?>

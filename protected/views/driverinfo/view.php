<?php
$this->breadcrumbs=array(
	'Driver Infos'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List DriverInfo','url'=>array('index')),
array('label'=>'Create DriverInfo','url'=>array('create')),
array('label'=>'Update DriverInfo','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete DriverInfo','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage DriverInfo','url'=>array('admin')),
);
?>

<h1>View DriverInfo #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'fname',
		'mname',
		'lname',
		'photo',
		'address',
		'gender',
		'date_of_birth',
		'mobile',
		'landline',
		'em_contact_name',
		'em_contact_relation',
		'em_contact_number',
		'created_by',
		'created_date',
),
)); ?>

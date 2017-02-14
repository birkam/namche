<?php
$this->breadcrumbs=array(
	'User Details'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List UserDetails','url'=>array('index')),
array('label'=>'Create UserDetails','url'=>array('create')),
array('label'=>'Update UserDetails','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete UserDetails','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage UserDetails','url'=>array('admin')),
);
?>

<div class="title"><h5>View User Details ::<?php echo $model->id; ?>::</h5></div>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'name',
		'address',
		'email',
		'phone',
		'mobile',
		'academic_qualification',
		'professional_qualification',
		'enrolled_date',
		'created_by',
		'created_date',
),
)); ?>

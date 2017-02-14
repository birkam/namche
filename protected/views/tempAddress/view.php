<?php
$this->breadcrumbs=array(
	'Temp Addresses'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List TempAddress','url'=>array('index')),
array('label'=>'Create TempAddress','url'=>array('create')),
array('label'=>'Update TempAddress','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete TempAddress','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage TempAddress','url'=>array('admin')),
);
?>
<div class="title"><h5>View Temporary Address ::<?php echo $model->id; ?>::</h5></div>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'busOwnerId',
		'zone',
		'district',
		'ward',
		'vdc_municipality',
		'tole',
		'house_no',
		'created_by',
		'created_date',
),
)); ?>

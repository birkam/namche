<?php
$this->breadcrumbs=array(
	'Cost Configurations'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List CostConfiguration','url'=>array('index')),
array('label'=>'Create CostConfiguration','url'=>array('create')),
array('label'=>'Update CostConfiguration','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete CostConfiguration','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage CostConfiguration','url'=>array('admin')),
);
?>

<h1>View CostConfiguration #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'particular',
		'rate',
		'created_by',
		'created_date',
),
)); ?>

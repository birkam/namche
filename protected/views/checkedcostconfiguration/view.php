<?php
$this->breadcrumbs=array(
	'Checked Cost Configurations'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List CheckedCostConfiguration','url'=>array('index')),
array('label'=>'Create CheckedCostConfiguration','url'=>array('create')),
array('label'=>'Update CheckedCostConfiguration','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete CheckedCostConfiguration','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage CheckedCostConfiguration','url'=>array('admin')),
);
?>

<h1>View CheckedCostConfiguration #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'bus_id',
		'checked_id',
        'checked_rate',
		'created_by',
		'created_date',
),
)); ?>

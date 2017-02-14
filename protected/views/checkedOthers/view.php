<?php
$this->breadcrumbs=array(
	'Checked Others'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List CheckedOthers','url'=>array('index')),
array('label'=>'Create CheckedOthers','url'=>array('create')),
array('label'=>'Update CheckedOthers','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete CheckedOthers','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage CheckedOthers','url'=>array('admin')),
);
?>

<h1>View CheckedOthers #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'bus_id',
		'checked_cost_conf_id',
		'particular',
		'amount',
		'created_by',
		'created_date',
),
)); ?>

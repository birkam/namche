<?php
/* @var $this RouteCostController */
/* @var $model RouteCost */

$this->breadcrumbs=array(
	'Route Costs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List RouteCost', 'url'=>array('index')),
	array('label'=>'Create RouteCost', 'url'=>array('create')),
	array('label'=>'Update RouteCost', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RouteCost', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RouteCost', 'url'=>array('admin')),
);
?>

<div class="title"><h5>View Route Costs ::<?php echo strtoupper($route->route_name); ?>::</h5></div>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'route_id',
		'samiti_sulka',
		'bhalai_kosh',
		'samrakshan',
		'ticket',
		'sahayog',
		'bima',
		'bibidh',
		'mandir',
		'jokhim',
		'anugaman',
		'bi_bya_sulka',
		'ma_kosh',
		'cost_status',
		'created_by',
		'created_date',
	),
)); ?>

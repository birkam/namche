<?php
/* @var $this RouteCostController */
/* @var $model RouteCost */

$this->breadcrumbs=array(
	'Route Costs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RouteCost', 'url'=>array('index')),
	array('label'=>'Manage RouteCost', 'url'=>array('admin')),
);
?>

	<div class="title"><h5>Create Route Costs</h5></div>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
/* @var $this RouteCostController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Route Costs',
);

$this->menu=array(
	array('label'=>'Create RouteCost', 'url'=>array('create')),
	array('label'=>'Manage RouteCost', 'url'=>array('admin')),
);
?>

<div class="title"><h5> Route Costs</h5></div>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

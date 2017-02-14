<?php
$this->breadcrumbs=array(
	'Bus And Drivers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List BusAndDriver','url'=>array('index')),
	array('label'=>'Create BusAndDriver','url'=>array('create')),
	array('label'=>'View BusAndDriver','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage BusAndDriver','url'=>array('admin')),
	);
	?>

	<div class="title"><h5>Update Bus and Drivers ::<?php echo $model->id; ?>::</h5></div>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
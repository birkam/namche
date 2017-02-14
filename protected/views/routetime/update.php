<?php
$this->breadcrumbs=array(
	'Route Times'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List RouteTime','url'=>array('index')),
	array('label'=>'Create RouteTime','url'=>array('create')),
	array('label'=>'View RouteTime','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage RouteTime','url'=>array('admin')),
	);
	?>

	<h1>Update RouteTime <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
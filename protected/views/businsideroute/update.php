<?php
$this->breadcrumbs=array(
	'Bus Inside Routes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List BusInsideRoute','url'=>array('index')),
	array('label'=>'Create BusInsideRoute','url'=>array('create')),
	array('label'=>'View BusInsideRoute','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage BusInsideRoute','url'=>array('admin')),
	);
	?>

	<h1>Update BusInsideRoute <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
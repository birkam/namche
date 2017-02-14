<?php
$this->breadcrumbs=array(
	'Bus And Owners'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List BusAndOwner','url'=>array('index')),
	array('label'=>'Create BusAndOwner','url'=>array('create')),
	array('label'=>'View BusAndOwner','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage BusAndOwner','url'=>array('admin')),
	);
	?>

	<h1>Update BusAndOwner <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
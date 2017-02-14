<?php
$this->breadcrumbs=array(
	'Driver Infos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List DriverInfo','url'=>array('index')),
	array('label'=>'Create DriverInfo','url'=>array('create')),
	array('label'=>'View DriverInfo','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage DriverInfo','url'=>array('admin')),
	);
	?>

	<h1>Update DriverInfo <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
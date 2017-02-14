<?php
$this->breadcrumbs=array(
	'Bus Owner Contacts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List BusOwnerContact','url'=>array('index')),
	array('label'=>'Create BusOwnerContact','url'=>array('create')),
	array('label'=>'View BusOwnerContact','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage BusOwnerContact','url'=>array('admin')),
	);
	?>

	<h1>Update BusOwnerContact <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
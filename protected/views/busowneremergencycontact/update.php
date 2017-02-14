<?php
$this->breadcrumbs=array(
	'Bus Owner Emergency Contacts'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List BusOwnerEmergencyContact','url'=>array('index')),
	array('label'=>'Create BusOwnerEmergencyContact','url'=>array('create')),
	array('label'=>'View BusOwnerEmergencyContact','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage BusOwnerEmergencyContact','url'=>array('admin')),
	);
	?>

	<h1>Update BusOwnerEmergencyContact <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
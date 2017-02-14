<?php
$this->breadcrumbs=array(
	'Bus Owner Emergency Contacts'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List BusOwnerEmergencyContact','url'=>array('index')),
array('label'=>'Manage BusOwnerEmergencyContact','url'=>array('admin')),
);
?>

<h1>Create BusOwnerEmergencyContact</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
$this->breadcrumbs=array(
	'Bus Owner Contacts'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List BusOwnerContact','url'=>array('index')),
array('label'=>'Manage BusOwnerContact','url'=>array('admin')),
);
?>

<h1>Create BusOwnerContact</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
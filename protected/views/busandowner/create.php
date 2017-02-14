<?php
$this->breadcrumbs=array(
	'Bus And Owners'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List BusAndOwner','url'=>array('index')),
array('label'=>'Manage BusAndOwner','url'=>array('admin')),
);
?>

<h1>Create BusAndOwner</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
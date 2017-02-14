<?php
$this->breadcrumbs=array(
	'Driver Infos'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List DriverInfo','url'=>array('index')),
array('label'=>'Manage DriverInfo','url'=>array('admin')),
);
?>

<h1>Create DriverInfo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
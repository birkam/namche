<?php
$this->breadcrumbs=array(
	'Route Times'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List RouteTime','url'=>array('index')),
array('label'=>'Manage RouteTime','url'=>array('admin')),
);
?>

<h1>Create RouteTime</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
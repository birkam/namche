<?php
$this->breadcrumbs=array(
	'Bus Removed Frm Queues'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List BusRemovedFrmQueue','url'=>array('index')),
array('label'=>'Manage BusRemovedFrmQueue','url'=>array('admin')),
);
?>

<h1>Create BusRemovedFrmQueue</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
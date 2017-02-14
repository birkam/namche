<?php
$this->breadcrumbs=array(
	'Bus Removed Frm Queues'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List BusRemovedFrmQueue','url'=>array('index')),
	array('label'=>'Create BusRemovedFrmQueue','url'=>array('create')),
	array('label'=>'View BusRemovedFrmQueue','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage BusRemovedFrmQueue','url'=>array('admin')),
	);
	?>

	<h1>Update BusRemovedFrmQueue <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
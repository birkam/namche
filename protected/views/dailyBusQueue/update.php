<?php
$this->breadcrumbs=array(
	'Daily Bus Queues'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List DailyBusQueue','url'=>array('index')),
	array('label'=>'Create DailyBusQueue','url'=>array('create')),
	array('label'=>'View DailyBusQueue','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage DailyBusQueue','url'=>array('admin')),
	);
	?>

	<h1>Update DailyBusQueue <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
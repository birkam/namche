<?php
$this->breadcrumbs=array(
	'Bus Insurances'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List BusInsurance','url'=>array('index')),
	array('label'=>'Create BusInsurance','url'=>array('create')),
	array('label'=>'View BusInsurance','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage BusInsurance','url'=>array('admin')),
	);
	?>

	<h1>Update BusInsurance <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
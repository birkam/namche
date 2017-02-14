<?php
$this->breadcrumbs=array(
	'Fileno Buses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List FilenoBus','url'=>array('index')),
	array('label'=>'Create FilenoBus','url'=>array('create')),
	array('label'=>'View FilenoBus','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage FilenoBus','url'=>array('admin')),
	);
	?>

	<div class="title"><h5>Update FilenoBus ::<?php echo $model->id; ?>::</h5></div>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
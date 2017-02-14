<?php
$this->breadcrumbs=array(
	'Temp Addresses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List TempAddress','url'=>array('index')),
	array('label'=>'Create TempAddress','url'=>array('create')),
	array('label'=>'View TempAddress','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage TempAddress','url'=>array('admin')),
	);
	?>

	<div class="title"><h5>Update Temporary Address ::<?php echo $model->id; ?>::</h5></div>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
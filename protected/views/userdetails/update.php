<?php
$this->breadcrumbs=array(
	'User Details'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List UserDetails','url'=>array('index')),
	array('label'=>'Create UserDetails','url'=>array('create')),
	array('label'=>'View UserDetails','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage UserDetails','url'=>array('admin')),
	);
	?>

	<div class="title"><h5>Update User Details::<?php $model->id; ?>::</h5></div>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
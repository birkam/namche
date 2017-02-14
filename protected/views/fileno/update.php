<?php
$this->breadcrumbs=array(
	'File Nos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List FileNo','url'=>array('index')),
	array('label'=>'Create FileNo','url'=>array('create')),
	array('label'=>'View FileNo','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage FileNo','url'=>array('admin')),
	);
	?>

	<h1>Update FileNo <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
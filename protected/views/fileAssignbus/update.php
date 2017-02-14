<?php
$this->breadcrumbs=array(
	'File Assignbuses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List FileAssignbus','url'=>array('index')),
	array('label'=>'Create FileAssignbus','url'=>array('create')),
	array('label'=>'View FileAssignbus','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage FileAssignbus','url'=>array('admin')),
	);
	?>

	<h1>Update FileAssignbus <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
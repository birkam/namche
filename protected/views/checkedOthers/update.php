<?php
$this->breadcrumbs=array(
	'Checked Others'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List CheckedOthers','url'=>array('index')),
	array('label'=>'Create CheckedOthers','url'=>array('create')),
	array('label'=>'View CheckedOthers','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage CheckedOthers','url'=>array('admin')),
	);
	?>

	<h1>Update CheckedOthers <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
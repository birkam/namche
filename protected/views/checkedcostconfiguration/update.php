<?php
$this->breadcrumbs=array(
	'Checked Cost Configurations'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List CheckedCostConfiguration','url'=>array('index')),
	array('label'=>'Create CheckedCostConfiguration','url'=>array('create')),
	array('label'=>'View CheckedCostConfiguration','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage CheckedCostConfiguration','url'=>array('admin')),
	);
	?>

	<h1>Update CheckedCostConfiguration <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
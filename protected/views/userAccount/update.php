<?php
$this->breadcrumbs=array(
	'User Accounts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List UserAccount','url'=>array('index')),
	array('label'=>'Create UserAccount','url'=>array('create')),
	array('label'=>'View UserAccount','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage UserAccount','url'=>array('admin')),
	);
	?>

	<h1>Update UserAccount <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
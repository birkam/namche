<?php
$this->breadcrumbs=array(
	'Bus Owners'=>array('index'),
	$model->fname=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List BusOwner','url'=>array('index')),
	array('label'=>'Create BusOwner','url'=>array('create')),
	array('label'=>'View BusOwner','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage BusOwner','url'=>array('admin')),
	);
	?>


<?php echo $this->renderPartial('_formUpdate',array('model'=>$model,)); ?>
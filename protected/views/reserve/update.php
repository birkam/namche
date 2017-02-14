<?php
/* @var $this ReserveController */
/* @var $model Reserve */

$this->breadcrumbs=array(
	'Reserves'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Reserve', 'url'=>array('index')),
	array('label'=>'Create Reserve', 'url'=>array('create')),
	array('label'=>'View Reserve', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Reserve', 'url'=>array('admin')),
);
?>

	<div class="title"><h5>Update Reserve ::<?php echo $model->id; ?>::</h5></div>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
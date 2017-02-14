<?php
/* @var $this ReserveController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Reserves',
);

$this->menu=array(
	array('label'=>'Create Reserve', 'url'=>array('create')),
	array('label'=>'Manage Reserve', 'url'=>array('admin')),
);
?>

<div class="title"><h5> Reserves</h5></div>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

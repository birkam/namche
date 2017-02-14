<?php
$this->breadcrumbs=array(
	'Route Times',
);

$this->menu=array(
array('label'=>'Create RouteTime','url'=>array('create')),
array('label'=>'Manage RouteTime','url'=>array('admin')),
);
?>

<h1>Route Times</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>

<?php
$this->breadcrumbs=array(
	'Bus Inside Routes',
);

$this->menu=array(
array('label'=>'Create BusInsideRoute','url'=>array('create')),
array('label'=>'Manage BusInsideRoute','url'=>array('admin')),
);
?>

<h1>Bus Inside Routes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>

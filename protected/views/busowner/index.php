<?php
$this->breadcrumbs=array(
	'Bus Owners',
);

$this->menu=array(
array('label'=>'Create BusOwner','url'=>array('create')),
array('label'=>'Manage BusOwner','url'=>array('admin')),
);
?>

<h1>Bus Owners</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>

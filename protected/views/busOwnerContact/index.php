<?php
$this->breadcrumbs=array(
	'Bus Owner Contacts',
);

$this->menu=array(
array('label'=>'Create BusOwnerContact','url'=>array('create')),
array('label'=>'Manage BusOwnerContact','url'=>array('admin')),
);
?>

<h1>Bus Owner Contacts</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>

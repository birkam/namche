<?php
$this->breadcrumbs=array(
	'Bus Owner Emergency Contacts',
);

$this->menu=array(
array('label'=>'Create BusOwnerEmergencyContact','url'=>array('create')),
array('label'=>'Manage BusOwnerEmergencyContact','url'=>array('admin')),
);
?>

<h1>Bus Owner Emergency Contacts</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>

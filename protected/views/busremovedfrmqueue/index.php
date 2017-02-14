<?php
$this->breadcrumbs=array(
	'Bus Removed Frm Queues',
);

$this->menu=array(
array('label'=>'Create BusRemovedFrmQueue','url'=>array('create')),
array('label'=>'Manage BusRemovedFrmQueue','url'=>array('admin')),
);
?>

<h1>Bus Removed Frm Queues</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>

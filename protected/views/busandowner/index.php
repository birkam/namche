<?php
$this->breadcrumbs=array(
	'Bus And Owners',
);

$this->menu=array(
array('label'=>'Create BusAndOwner','url'=>array('create')),
array('label'=>'Manage BusAndOwner','url'=>array('admin')),
);
?>

<h1>Bus And Owners</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>

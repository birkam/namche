<?php
$this->breadcrumbs=array(
	'Bus And Drivers',
);

$this->menu=array(
array('label'=>'Create BusAndDriver','url'=>array('create')),
array('label'=>'Manage BusAndDriver','url'=>array('admin')),
);
?>

<div class="title"><h5>Bus And Drivers</h5></div>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>

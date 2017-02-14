<?php
$this->breadcrumbs=array(
	'Driver Infos',
);

$this->menu=array(
array('label'=>'Create DriverInfo','url'=>array('create')),
array('label'=>'Manage DriverInfo','url'=>array('admin')),
);
?>

<h1>Driver Infos</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>

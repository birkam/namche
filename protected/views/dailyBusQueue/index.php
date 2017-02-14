<?php
$this->breadcrumbs=array(
	'Daily Bus Queues',
);

$this->menu=array(
array('label'=>'Create DailyBusQueue','url'=>array('create')),
array('label'=>'Manage DailyBusQueue','url'=>array('admin')),
);
?>

<h1>Daily Bus Queues</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>

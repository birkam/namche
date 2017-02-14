<?php
$this->breadcrumbs=array(
	'Checked Cost Configurations',
);

$this->menu=array(
array('label'=>'Create CheckedCostConfiguration','url'=>array('create')),
array('label'=>'Manage CheckedCostConfiguration','url'=>array('admin')),
);
?>

<h1>Checked Cost Configurations</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>

<?php
$this->breadcrumbs=array(
	'Temp Addresses',
);

$this->menu=array(
array('label'=>'Create TempAddress','url'=>array('create')),
array('label'=>'Manage TempAddress','url'=>array('admin')),
);
?>

<div class="title"><h5>Temporary Address</h5></div>


<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>

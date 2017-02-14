<?php
$this->breadcrumbs=array(
	'Fileno Buses',
);

$this->menu=array(
array('label'=>'Create FilenoBus','url'=>array('create')),
array('label'=>'Manage FilenoBus','url'=>array('admin')),
);
?>

<div class="title"> <h5>Fileno Buses</h5></div>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>

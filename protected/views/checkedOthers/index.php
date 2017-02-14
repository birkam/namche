<?php
$this->breadcrumbs=array(
	'Checked Others',
);

$this->menu=array(
array('label'=>'Create CheckedOthers','url'=>array('create')),
array('label'=>'Manage CheckedOthers','url'=>array('admin')),
);
?>

<h1>Checked Others</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>

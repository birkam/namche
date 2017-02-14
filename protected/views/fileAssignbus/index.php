<?php
$this->breadcrumbs=array(
	'File Assignbuses',
);

$this->menu=array(
array('label'=>'Create FileAssignbus','url'=>array('create')),
array('label'=>'Manage FileAssignbus','url'=>array('admin')),
);
?>

<h1>File Assignbuses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>

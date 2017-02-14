<?php
$this->breadcrumbs=array(
	'File Nos',
);

$this->menu=array(
array('label'=>'Create FileNo','url'=>array('create')),
array('label'=>'Manage FileNo','url'=>array('admin')),
);
?>

<h1>File Nos</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>

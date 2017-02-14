<?php
$this->breadcrumbs=array(
	'Busowner Attachments',
);

$this->menu=array(
array('label'=>'Create BusownerAttachments','url'=>array('create')),
array('label'=>'Manage BusownerAttachments','url'=>array('admin')),
);
?>

<h1>Busowner Attachments</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>

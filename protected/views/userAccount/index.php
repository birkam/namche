<?php
$this->breadcrumbs=array(
	'User Accounts',
);

$this->menu=array(
array('label'=>'Create UserAccount','url'=>array('create')),
array('label'=>'Manage UserAccount','url'=>array('admin')),
);
?>

<h1>User Accounts</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>

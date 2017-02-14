<?php
$this->breadcrumbs=array(
	'Activerecordlogs',
);

$this->menu=array(
array('label'=>'Create Activerecordlog','url'=>array('create')),
array('label'=>'Manage Activerecordlog','url'=>array('admin')),
);
?>

<div class="title"><h5> Active Record Log</h5></div>


<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>

<?php
$this->breadcrumbs=array(
	'Activerecordlogs'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List Activerecordlog','url'=>array('index')),
array('label'=>'Manage Activerecordlog','url'=>array('admin')),
);
?>


	<div class="title"><h5>Create Active Record Log</h5></div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
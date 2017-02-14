<?php
$this->breadcrumbs=array(
	'Temp Addresses'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List TempAddress','url'=>array('index')),
array('label'=>'Manage TempAddress','url'=>array('admin')),
);
?>
	<div class="title"><h5>Create Temporary Address</h5></div>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
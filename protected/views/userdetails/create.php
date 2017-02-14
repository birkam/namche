<?php
$this->breadcrumbs=array(
	'User Details'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List UserDetails','url'=>array('index')),
array('label'=>'Manage UserDetails','url'=>array('admin')),
);
?>

	<div class="title"><h5>Create User Details</h5></div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
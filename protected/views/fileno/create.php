<?php
$this->breadcrumbs=array(
	'File Nos'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List FileNo','url'=>array('index')),
array('label'=>'Manage FileNo','url'=>array('admin')),
);
?>

<h1>Create FileNo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
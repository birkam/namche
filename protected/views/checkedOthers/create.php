<?php
$this->breadcrumbs=array(
	'Checked Others'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List CheckedOthers','url'=>array('index')),
array('label'=>'Manage CheckedOthers','url'=>array('admin')),
);
?>

<h1>Create CheckedOthers</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
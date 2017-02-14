<?php
$this->breadcrumbs=array(
	'User Accounts'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List UserAccount','url'=>array('index')),
array('label'=>'Manage UserAccount','url'=>array('admin')),
);
?>

<h1>Create UserAccount</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
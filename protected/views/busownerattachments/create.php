<?php
$this->breadcrumbs=array(
	'Busowner Attachments'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List BusownerAttachments','url'=>array('index')),
array('label'=>'Manage BusownerAttachments','url'=>array('admin')),
);
?>

<h1>Create BusownerAttachments</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
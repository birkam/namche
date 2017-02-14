<?php
$this->breadcrumbs=array(
	'Busowner Attachments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List BusownerAttachments','url'=>array('index')),
	array('label'=>'Create BusownerAttachments','url'=>array('create')),
	array('label'=>'View BusownerAttachments','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage BusownerAttachments','url'=>array('admin')),
	);
	?>

	<h1>Update BusownerAttachments <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
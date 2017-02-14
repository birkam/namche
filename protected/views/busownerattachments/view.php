<?php
$this->breadcrumbs=array(
	'Busowner Attachments'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List BusownerAttachments','url'=>array('index')),
array('label'=>'Create BusownerAttachments','url'=>array('create')),
array('label'=>'Update BusownerAttachments','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete BusownerAttachments','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage BusownerAttachments','url'=>array('admin')),
);
?>

<h1>View BusownerAttachments #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'busOwnerId',
		'image',
		'description',
		'created_by',
		'created_date',
),
)); ?>

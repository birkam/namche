<?php
$this->breadcrumbs=array(
	'File Nos'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List FileNo','url'=>array('index')),
array('label'=>'Create FileNo','url'=>array('create')),
array('label'=>'Update FileNo','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete FileNo','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage FileNo','url'=>array('admin')),
);
?>
<?php var_dump(Yii::app()->session['username']);?>
<h1>View File Number</h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
//		'id',
		'file_no',
    array('label'=>$model->file->getAttributeLabel('created_by'),
        'value'=>strtolower($model->file->user_name)),
		'created_date',
),
)); ?>

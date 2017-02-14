<?php
$this->breadcrumbs=array(
	'Bus Owners'=>array('index'),
	$model->fname,
);

$this->menu=array(
array('label'=>'List BusOwner','url'=>array('index')),
array('label'=>'Create BusOwner','url'=>array('create')),
array('label'=>'Update BusOwner','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete BusOwner','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage BusOwner','url'=>array('admin')),
);
?>

<h1>View BusOwner #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(// marital_status, gender, date_of_birth, nationality,
    'data'=>$model,
    'attributes'=>array(
        'id',
        'fname',
        'mname',
        'lname',
        'gender',
        'marital_status',
        'nationality',
        'date_of_birth',
        'id_no',
        'photo',
        'created_by',
        'created_date',
    ),
)); ?>

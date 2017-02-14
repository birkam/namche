<?php
$this->breadcrumbs=array(
	'User Accounts'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List UserAccount','url'=>array('index')),
array('label'=>'Create UserAccount','url'=>array('create')),
array('label'=>'Update UserAccount','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete UserAccount','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage UserAccount','url'=>array('admin')),
);
?>

<!--<h1>View UserAccount #--><?php //echo $model->id; ?><!--</h1>-->

<?php
$this->widget('bootstrap.widgets.TbAlert', array(
    'fade' => true,
    'closeText' => '&times;', // false equals no close link
    'events' => array(),
    'htmlOptions' => array(),
    'userComponentId' => 'user',
    'alerts' => array( // configurations per alert type
        // success, info, warning, error or danger
        'success' => array('closeText' => '&times;'),
        'info', // you don't need to specify full config
        'warning' => array('closeText' => false),
        'error' => array('closeText' => 'AAARGHH!!')
    ),
));
?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
    'data'=>$model,
    'attributes'=>array(
        'id',
        'user_id',
        'email',
        'user_name',
        'password',
        'role',
        'status',
        'created_by',
        'created_date',
    ),
)); ?>

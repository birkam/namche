<?php
$this->breadcrumbs=array(
	'Buses'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List Bus','url'=>array('index')),
array('label'=>'Manage Bus','url'=>array('admin')),
);
?>
<?php
$this->widget(
    'bootstrap.widgets.TbTabs',
    array(
        'type' => 'tabs', // 'tabs' or 'pills'
        'tabs' => array(
            array('label'=>'Manage', 'url'=>array('/bus/admin?mod=up')),
        ),
    )
);
?>

    <div class="title"><h5>Create Bus</h5></div>

<?php echo $this->renderPartial('_form', array('model'=>$model
    //'busAndOwner'=>$busAndOwner
)); ?>
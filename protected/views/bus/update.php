<?php
$this->breadcrumbs=array(
    'Buses'=>array('index'),
    $model->id=>array('view','id'=>$model->id),
    'Update',
);

$this->menu=array(
    array('label'=>'List Bus','url'=>array('index')),
    array('label'=>'Create Bus','url'=>array('create')),
    array('label'=>'View Bus','url'=>array('view','id'=>$model->id)),
    array('label'=>'Manage Bus','url'=>array('admin')),
);
?>
<?php
$this->widget(
    'bootstrap.widgets.TbTabs',
    array(
        'type' => 'tabs', // 'tabs' or 'pills'
        'tabs' => array(
            array('label'=>'Add New', 'url'=>array('/bus/create')),
            array('label'=>'Manage', 'url'=>array('/bus/admin?mod=up')),
            array('label'=>'View', 'url'=>array('/bus/view/'.$model->id)),
        ),
    )
);
?>

    <div class="title"><h5>Update Bus Number::<?php echo$model->bus_no ?>::</h5></div>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
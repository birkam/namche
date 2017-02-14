<?php
$this->breadcrumbs=array(
	'Bus Owners'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List BusOwner','url'=>array('index')),
array('label'=>'Manage BusOwner','url'=>array('admin')),
);
?>
<?php
$this->widget(
    'bootstrap.widgets.TbTabs',
    array(
        'type' => 'tabs', // 'tabs' or 'pills'
        'tabs' => array(
            array('label'=>'Manage', 'url'=>array('admin')),
        ),
    )
);
?>
<h1>Create BusOwner</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'busOwnAttach'=>$busOwnAttach, 'tempAddress'=>$tempAddress, 'busOwnContact'=>$busOwnContact, 'busOwnEmContact'=>$busOwnEmContact)); ?>
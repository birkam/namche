<?php
$this->breadcrumbs=array(
	'Bus Owners'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List BusOwner','url'=>array('index')),
array('label'=>'Create BusOwner','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('bus-owner-grid', {
data: $(this).serialize()
});
return false;
});
");
?>
<?php
$this->widget(
    'bootstrap.widgets.TbTabs',
    array(
        'type' => 'tabs', // 'tabs' or 'pills'
        'tabs' => array(
            array('label'=>'Add', 'url'=>array('create')),
        ),
    )
);
?>
<h1>Manage Bus Owners</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id'=>'bus-owner-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
//		'id',
        'fname',
        'mname',
        'lname',
        'id_no',
//        'photo',
        /*
		'created_by',
		'created_date',
		*/
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template' => '{view} {update}',
            'buttons' => array(
                'view' => array(
                    'label'=> 'View',
                    'url'=>'Yii::app()->controller->createUrl("busowner/".$data->id."?ref=oi")',
                ),
            ),
        ),
    ),
)); ?>

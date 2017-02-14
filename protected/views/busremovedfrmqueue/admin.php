<?php
$this->breadcrumbs=array(
    'Bus Removed Frm Queues'=>array('index'),
    'Manage',
);

$this->menu=array(
    array('label'=>'List BusRemovedFrmQueue','url'=>array('index')),
    array('label'=>'Create BusRemovedFrmQueue','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('bus-removed-frm-queue-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Manage Bus Removed Frm Queues</h1>



<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id'=>'bus-removed-frm-queue-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
//        'id',
//        'route_id',
        array( 'name'=>'route_names', 'value'=>'$data->route? $data->route->route_name: "-"' ),
//        'bus_id',
        array( 'name'=>'bus_numbers', 'value'=>'$data->busdetail? $data->busdetail->bus_no: "-"' ),
        'queue_date',
        array( 'name'=>'removed_by', 'value'=>'$data->created? $data->created->user_name: "-"' ),
        'created_date',
//        array(
//            'class'=>'bootstrap.widgets.TbButtonColumn',
//        ),
    ),
)); ?>

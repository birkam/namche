<?php
$this->breadcrumbs=array(
	'Bus Inside Routes'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List BusInsideRoute','url'=>array('index')),
array('label'=>'Create BusInsideRoute','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('bus-inside-route-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Manage Bus Inside Routes</h1>

<?php
$current_user=Yii::app()->user->id;
Yii::app()->session['userView'.$current_user.'returnURL']=Yii::app()->request->Url;

$stat = array('0'=>'Not Active', '1'=>'Active');
$this->widget('bootstrap.widgets.TbGridView',array(
    'id'=>'bus-inside-route-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
//		'id',
//		'route_id',
        array( 'name'=>'route_id', 'value'=>'$data->route? $data->route->route_name: "-"' ),
//		'bus_id',
        array( 'name'=>'bus_no', 'value'=>'$data->bus? $data->bus->bus_no: "-"' ),
//		'bus_status',
        array(
            'name'=>'bus_status',
            'value'=>'BusInsideRoute::stat($data->bus_status)',
            'filter'=>$stat
        ),
        'bus_assigned_date',
        'bus_out_date',
        /*
        'created_by',
        'created_date',
        */
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
        ),
    ),
)); ?>
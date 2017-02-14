<?php
$this->breadcrumbs=array(
	'Daily Bus Queues'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List DailyBusQueue','url'=>array('index')),
array('label'=>'Create DailyBusQueue','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('daily-bus-queue-grid', {
data: $(this).serialize()
});
return false;
});
");
?>
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
        'error' => array('closeText' => '')
    ),
));
?>
<h1>Manage Daily Bus Queues</h1>

<!--<p>
	You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
		&lt;&gt;</b>
	or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php /*echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); */?>
<div class="search-form" style="display:none">
	--><?php /*$this->renderPartial('_search',array(
	'model'=>$model,
)); */?>
<!--</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'daily-bus-queue-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
//		'id',
//		'route_id',
    array( 'name'=>'route_name', 'value'=>'$data->bus_route? $data->bus_route->route_name: "-"' ),
		'queue_date',
//		'time_id',
//		'bus_id',
//		'bus_status',
		/*
		'created_by',
		'created_date',
		*/
    array(
        'class'=>'bootstrap.widgets.TbButtonColumn',
        'header'=>'<a>Actions</a>',
        'template' => '{view}',
        'buttons' => array(
            'view' => array(
                'label'=> 'View',
                'options'=>array(
                    'class'=>'btn btn-small view'
                )
            ),
        ),
        'htmlOptions'=>array('nowrap'=>'nowrap'),
    ),
),
)); ?>

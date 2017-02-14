<?php
$this->breadcrumbs=array(
	'Bus And Drivers'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List BusAndDriver','url'=>array('index')),
array('label'=>'Create BusAndDriver','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('bus-and-driver-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="title"><h5>Manage Bus and Drivers</h5></div>

<p>
	You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
		&lt;&gt;</b>
	or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'bus-and-driver-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		'bus_id',
		'driver_id',
		'driver_status',
		'driver_entered_date',
		'driver_left_date',
		/*
		'created_by',
		'created_date',
		*/
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>

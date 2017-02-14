<?php
/* @var $this ReserveController */
/* @var $model Reserve */

$this->breadcrumbs=array(
	'Reserves'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Reserve', 'url'=>array('index')),
	array('label'=>'Create Reserve', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#reserve-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="title"><h5>Manage Reserves</h5></div>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'reserve-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'bus_id',
		'checked_cost_conf_id',
		'samiti_sulka',
		'bhalai_kosh',
		'samrakshan',
		/*
		'ticket',
		'sahayog',
		'bima',
		'bibidh',
		'mandir',
		'jokhim',
		'anugaman',
		'bi_bya_sulka',
		'ma_kosh',
		'reserve_date',
		'reserve_time',
		'created_by',
		'created_nep_date',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

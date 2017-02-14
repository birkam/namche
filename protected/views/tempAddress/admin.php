<?php
$this->breadcrumbs=array(
	'Temp Addresses'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List TempAddress','url'=>array('index')),
array('label'=>'Create TempAddress','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('temp-address-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="title"><h5>Manage Temporary Address</h5></div>

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
'id'=>'temp-address-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		'busOwnerId',
		'zone',
		'district',
		'ward',
		'vdc_municipality',
		/*
		'tole',
		'house_no',
		'created_by',
		'created_date',
		*/
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>

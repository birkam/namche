<?php
$this->breadcrumbs=array(
	'Bus Insurances'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List BusInsurance','url'=>array('index')),
array('label'=>'Create BusInsurance','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('bus-insurance-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Manage Bus Insurances</h1>

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
'id'=>'bus-insurance-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		'bus_id',
		'insurance_company',
		'insurance_account',
		'ac_holder_name',
		'tax_invoice_no',
		/*
		'police_no',
		'issue_date',
		'expiry_date',
		'remarks',
		'created_by',
		'created_date',
		*/
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>

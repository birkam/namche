<?php
/* @var $this ReserveController */
/* @var $model Reserve */

$this->breadcrumbs=array(
	'Reserves'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Reserve', 'url'=>array('index')),
	array('label'=>'Create Reserve', 'url'=>array('create')),
	array('label'=>'Update Reserve', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Reserve', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Reserve', 'url'=>array('admin')),
);
?>

<div class="title"><h5>View Reserve #<?php echo $model->id; ?></h5></div>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'bus_id',
		'checked_cost_conf_id',
		'samiti_sulka',
		'bhalai_kosh',
		'samrakshan',
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
	),
)); ?>

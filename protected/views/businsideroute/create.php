<?php
$this->breadcrumbs=array(
	'Bus Inside Routes'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List BusInsideRoute','url'=>array('index')),
array('label'=>'Manage BusInsideRoute','url'=>array('admin')),
);
?>

<h1>Create Bus Inside Route "<?php echo strtoupper(Route::model()->findByPk($route_id)->route_name); ?>"</h1>

<?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="flash-success">
        <p><?php echo Yii::app()->user->getFlash('success'); ?></p>
    </div>
<?php endif; ?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
$current_user=Yii::app()->user->id;
Yii::app()->session['userView'.$current_user.'returnURL']=Yii::app()->request->Url;

$stat = array('0'=>'Not Active', '1'=>'Active');
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'bus-inside-route-grid',
	'dataProvider'=>$modelsearch->search(),
	'filter'=>$modelsearch,
	'columns'=>array(
//		'id',
//		'route_id',
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
            'template'=>'{viewBus}{removeBus}',
            'buttons' => array(
                'viewBus' => array(
                    'label' => 'View Bus',
                    'url' => 'CHtml::normalizeUrl(array("bus/".rawurlencode($data->bus_id)))', //Your URL According to your wish
                ),
                'removeBus' => array(
                    'label' => 'Remove Bus',
                    'visible'=>'($data->bus_status == 1)?true:false;',
                    'url' => 'CHtml::normalizeUrl(array("busInsideRoute/remove/".rawurlencode($data->id)))', //Your URL According to your wish
                ),
            ),
		),
	),
)); ?>

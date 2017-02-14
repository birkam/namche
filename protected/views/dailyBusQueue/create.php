<?php
$this->breadcrumbs=array(
	'Daily Bus Queues'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List DailyBusQueue','url'=>array('index')),
array('label'=>'Manage DailyBusQueue','url'=>array('admin')),
);
?>
<?php if(Yii::app()->user->hasFlash('error')):?>
    <div class="flash-error">
        <p><?php echo Yii::app()->user->getFlash('error'); ?></p>
    </div>
<?php endif; ?>
<h1>Create DailyBusQueue</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'route_id'=>$route_id)); ?>
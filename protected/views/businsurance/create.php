<?php
$this->breadcrumbs=array(
    'Bus Insurances'=>array('index'),
    'Create',
);

$this->menu=array(
    array('label'=>'List BusInsurance','url'=>array('index')),
    array('label'=>'Manage BusInsurance','url'=>array('admin')),
);
?>
<?php $bus = Bus::model()->findByPk($bus_id);?>
    <h1>Create Insurance for Bus No.: "<?php echo strtoupper($bus->bus_no);?>"</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
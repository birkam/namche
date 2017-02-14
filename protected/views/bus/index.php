<?php
$this->breadcrumbs=array(
    'Buses',
);

$this->menu=array(
    array('label'=>'Create Bus','url'=>array('create')),
    array('label'=>'Manage Bus','url'=>array('admin')),
);
?>

<!--Bus, Owner and File no ** -->
<div class="widget">
    <div class="head"><h5 class="iBus">Bus, Owner and File no Management</h5></div>
    <div class="body aligncenter">
        <a href="<?php echo Yii::app()->request->baseUrl; ?>/Bus/Create" title="" class="btnIconLeft mr10"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/middlenav/bus_register.png" alt="" class="icon"><span>Bus Register</span></a>
        <a href="<?php echo Yii::app()->request->baseUrl; ?>/BusOwner/Create" title="" class="btnIconLeft mr10"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/middlenav/owner.png" alt="" class="icon"><span>Owner Register</span></a>
        <a href="<?php echo Yii::app()->request->baseUrl; ?>/DriverInfo/Create" title="" class="btnIconLeft mr10"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/middlenav/driver.png" alt="" class="icon"><span>Driver Register</span></a>
        <a href="<?php echo Yii::app()->request->baseUrl; ?>/FileNo/Admin?mod=otf" title="" class="btnIconLeft mr10"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/middlenav/file_owner.png" alt="" class="icon"><span>Assign Owner to File no</span></a>
        <a href="<?php echo Yii::app()->request->baseUrl; ?>/FileNo/Admin?mod=btf" title="" class="btnIconLeft"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/middlenav/file_bus.png" alt="" class="icon"><span>Assign Bus to File no</span></a>
    </div>
</div>

<!--<h1>Buses</h1>-->
<!---->
<?php //$this->widget('bootstrap.widgets.TbListView',array(
//'dataProvider'=>$dataProvider,
//'itemView'=>'_view',
//)); ?>

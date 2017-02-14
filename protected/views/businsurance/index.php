<?php
$this->breadcrumbs=array(
	'Bus Insurances',
);

$this->menu=array(
array('label'=>'Create BusInsurance','url'=>array('create')),
array('label'=>'Manage BusInsurance','url'=>array('admin')),
);
?>

<!--    Insurance management-->
<div class="widget">
    <div class="head"><h5 class="iImage2">Insurance</h5></div>
    <div class="body aligncenter">
        <a href="<?php echo Yii::app()->request->baseUrl; ?>/BusInsurance/Admin" title="" class="btnIconLeft mr10"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/dark/priceTag.png" alt="" class="icon"><span>Browse Insurance</span></a>
        <a href="<?php echo Yii::app()->request->baseUrl; ?>/Bus/Admin?mod=ins" title="" class="btnIconLeft mr10"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/dark/image2.png" alt="" class="icon"><span>Bus Insurance</span></a>
        <a href="<?php echo Yii::app()->request->baseUrl; ?>/Bus/Admin?mod=exp" title="" class="btnIconLeft mr10"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/dark/priceTag.png" alt="" class="icon"><span>Expired Insurance</span></a>
    </div>
</div>

<!--<h1>Bus Insurances</h1>-->
<!---->
<?php //$this->widget('bootstrap.widgets.TbListView',array(
//'dataProvider'=>$dataProvider,
//'itemView'=>'_view',
//)); ?>

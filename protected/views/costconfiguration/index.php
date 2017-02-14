<?php
$this->breadcrumbs=array(
	'Cost Configurations',
);

$this->menu=array(
array('label'=>'Create CostConfiguration','url'=>array('create')),
array('label'=>'Manage CostConfiguration','url'=>array('admin')),
);
?>

<!--    Cost Configuration-->
<div class="widget">
    <div class="head"><h5 class="iImage2">Cost Configuration</h5></div>
    <div class="body aligncenter">
        <a href="<?php echo Yii::app()->request->baseUrl; ?>/CostConfiguration/Admin" title="" class="btnIconLeft mr10"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/dark/priceTag.png" alt="" class="icon"><span>Browse Cost Configuration</span></a>

        <a href="<?php echo Yii::app()->request->baseUrl; ?>/CostConfiguration/Create" title="" class="btnIconLeft mr10"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/dark/image2.png" alt="" class="icon"><span>Create Cost Configuration</span></a>
        <a href="<?php echo Yii::app()->request->baseUrl; ?>/Bus/Admin?mod=ccc" title="" class="btnIconLeft mr10"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/dark/priceTag.png" alt="" class="icon"><span>Check Cost Configuration</span></a>
    </div>
</div>


<!--<h1>Cost Configurations</h1>-->
<!---->
<?php //$this->widget('bootstrap.widgets.TbListView',array(
//'dataProvider'=>$dataProvider,
//'itemView'=>'_view',
//)); ?>

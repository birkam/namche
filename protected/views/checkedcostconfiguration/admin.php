<?php
$this->breadcrumbs=array(
    'Checked Cost Configurations'=>array('index'),
    'Manage',
);

$this->menu=array(
    array('label'=>'List CheckedCostConfiguration','url'=>array('index')),
    array('label'=>'Create CheckedCostConfiguration','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('checked-cost-configuration-grid', {
data: $(this).serialize()
});
return false;
});
");
?>
<div class="title"> <h5>Receipts</h5></div>
<?php
$pageSize = Yii::app()->user->getState( 'pageSize', Yii::app()->params[ 'defaultPageSize' ] );
$pageSizeDropDown = CHtml::dropDownList(
    'pageSize',
    $pageSize,
    array( 10 => 10, 25 => 25, 50 => 50, 100 => 100 ),
    array(
        'class'    => 'change-pagesize',
        'onchange' => "$.fn.yiiGridView.update('checked-cost-configuration-grid',{data:{pageSize:$(this).val()}});",
    )
);
?>
<div class="page-size-wrap">
    <span>Display by:</span><?= $pageSizeDropDown; ?>
</div>
<?php Yii::app()->clientScript->registerCss( 'initPageSizeCSS', '.page-size-wrap{text-align: right;}' ); ?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id'=>'checked-cost-configuration-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
//		'id',
//		'bus_id',
        array( 'name'=>'bus_no', 'value'=>'$data->bus? $data->bus->bus_no: "-"' ),
        'receipt_no',
//		'checked_id',
//		'created_by',
        array(
            'name'=>'cashier',
            'value'=>'$data->created? $data->created->user_name: "-"',
        ),
        'created_nep_date',
//				array(
//						'class'=>'CButtonColumn',
//						'template'=>'{view}',
//						'viewButtonUrl'=>'Yii::app()->createUrl("/CheckedCostConfiguration/view", array("id"=>$data["id"]))',
//
//				),
        array(
            'class'=>'zii.widgets.grid.CButtonColumn',
            'template' => '{view}',
            'buttons'=>array(
                'view' => array(
                    'url' => 'Yii::app()->createUrl("/CheckedCostConfiguration/view", array("id"=>$data["id"]))', // view url
//                        'options' => array('target' => '_blank'),
                    'options' => array('class' => 'newWindow'),
                ),
            ),
        ),
    ),
)); ?>


<script>
    $(document).ready(function()
    {
        $(".newWindow").click(function(e)
        {
            e.preventDefault();
            var url=$(this).attr('href');
            window.open(url, "_blank", "toolbar=no, scrollbars=no, resizable=no, top=100, left=100, width=770, height=500");
        });
    });
</script>

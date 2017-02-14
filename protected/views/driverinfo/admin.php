<?php
$this->breadcrumbs=array(
    'Driver Infos'=>array('index'),
    'Manage',
);

$this->menu=array(
    array('label'=>'List DriverInfo','url'=>array('index')),
    array('label'=>'Create DriverInfo','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('driver-info-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="title"><h5>Manage Driver Information</h5></div>

<?php
$pageSize = Yii::app()->user->getState( 'pageSize', Yii::app()->params[ 'defaultPageSize' ] );
$pageSizeDropDown = CHtml::dropDownList(
    'pageSize',
    $pageSize,
    array( 10 => 10, 25 => 25, 50 => 50, 100 => 100 ),
    array(
        'class'    => 'change-pagesize',
        'onchange' => "$.fn.yiiGridView.update('driver-info-grid',{data:{pageSize:$(this).val()}});",
    )
);
?>
<div class="page-size-wrap">
    <span>Display by:</span><?= $pageSizeDropDown; ?>
</div>
<?php Yii::app()->clientScript->registerCss( 'initPageSizeCSS', '.page-size-wrap{text-align: right;}' ); ?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id'=>'driver-info-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'summaryText'  => '{start} - {end} / {count}',
    'columns'=>array(
        'id',
        'fname',
        'mname',
        'lname',
        'photo',
        'address',
        /*
        'gender',
        'date_of_birth',
        'mobile',
        'landline',
        'em_contact_name',
        'em_contact_relation',
        'em_contact_number',
        'created_by',
        'created_date',
        */
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('nowrap'=>'nowrap'),
        ),
    ),
)); ?>

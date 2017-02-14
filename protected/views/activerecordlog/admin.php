<?php
$this->breadcrumbs=array(
    'Activerecordlogs'=>array('index'),
    'Manage',
);

$this->menu=array(
    array('label'=>'List Activerecordlog','url'=>array('index')),
    array('label'=>'Create Activerecordlog','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('activerecordlog-grid', {
data: $(this).serialize()
});
return false;
});
");
?>


<div class="title"><h5>Manage Active Record Log</h5></div>

<?php
$pageSize = Yii::app()->user->getState( 'pageSize', Yii::app()->params[ 'defaultPageSize' ] );
$pageSizeDropDown = CHtml::dropDownList(
    'pageSize',
    $pageSize,
    array( 10 => 10, 25 => 25, 50 => 50, 100 => 100 ),
    array(
        'class'    => 'change-pagesize',
        'onchange' => "$.fn.yiiGridView.update('activerecordlog-grid',{data:{pageSize:$(this).val()}});",
    )
);
?>

    <div class="page-size-wrap">
        <span>Display by:</span><?= $pageSizeDropDown; ?>
    </div>

<?php Yii::app()->clientScript->registerCss( 'initPageSizeCSS', '.page-size-wrap{text-align: right;}' ); ?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id'=>'activerecordlog-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'summaryText'  => '{start} - {end} / {count}',
    'columns'=>array(
        'id',
        'description',
        'action',
        'model',
        'idModel',
        'field',
        /*
        'creationdate',
        'userid',
        */
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'header'=>'<a>Actions</a>',
            'template' => '{view}',
            'buttons' => array(
                'view' => array(
                    'label'=> 'View',
                    'options'=>array(
                        'class'=>'btn btn-small view'
                    )
                ),
            ),
            'htmlOptions'=>array('nowrap'=>'nowrap'),
        ),
    ),
)); ?>

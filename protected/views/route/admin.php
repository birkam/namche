<?php
$this->breadcrumbs=array(
	'Routes'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List Route','url'=>array('index')),
array('label'=>'Create Route','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('route-grid', {
data: $(this).serialize()
});
return false;
});
");
$mod = $_GET['mod'];
if($mod == 'rtac'){
?>
    <div class="title"><h5>Manage Time And Cost In Route</h5></div>

    <?php
    $pageSize = Yii::app()->user->getState( 'pageSize', Yii::app()->params[ 'defaultPageSize' ] );
    $pageSizeDropDown = CHtml::dropDownList(
        'pageSize',
        $pageSize,
        array( 10 => 10, 25 => 25, 50 => 50, 100 => 100 ),
        array(
            'class'    => 'change-pagesize',
            'onchange' => "$.fn.yiiGridView.update('route-grid',{data:{pageSize:$(this).val()}});",
        )
    );
    ?>
    <div class="page-size-wrap">
        <span>Display by:</span><?= $pageSizeDropDown; ?>
    </div>
    <?php Yii::app()->clientScript->registerCss( 'initPageSizeCSS', '.page-size-wrap{text-align: right;}' ); ?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'route-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		'route_name',
    'distance_km',
		'created_by',
		'created_date',
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
));
}elseif($mod == 'bq'){
?>
    <div class="title"><h5>Bus Queue</div><h5>

    <?php $this->widget('bootstrap.widgets.TbGridView',array(
        'id'=>'route-grid',
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'columns'=>array(
            'id',
            'route_name',
            'distance_km',
            'created_by',
            'created_date',
            array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'header'=>'<a>Actions</a>',
                'template' => '{view}{assign}',
                'buttons' => array(
                    'view' => array(
                        'label'=> 'View',
                        'options'=>array(
                            'class'=>'btn btn-small view'
                        )
                    ),
//            'update' => array(
//                'label'=> 'Update',
//                'options'=>array(
//                    'class'=>'btn btn-small update'
//                )
//            ),
                    /*'delete' => array(
                        'label'=> 'Delete',
                        'options'=>array(
                            'class'=>'btn btn-small delete'
                        )
                    ),*/
                    'assign'=>array(
                        'label'=>'Bus Queue',
                        'icon' => 'icon-edit',

                        'url'=>'Yii::app()->controller->createUrl("BusInsideRoute/QueueChart",array("id"=>$data->id))',
                        'options'=>array(
                            'class'=>'btn btn-small'
                        ),
                    ),
                ),
                'htmlOptions'=>array('nowrap'=>'nowrap'),
            ),
        ),
    ));
}
elseif($mod == 'bir'){
    ?>

    <div class="title"><h5>Manage Bus Inside Route</h5></div>
    <?php
    $pageSize = Yii::app()->user->getState( 'pageSize', Yii::app()->params[ 'defaultPageSize' ] );
    $pageSizeDropDown = CHtml::dropDownList(
        'pageSize',
        $pageSize,
        array( 10 => 10, 25 => 25, 50 => 50, 100 => 100 ),
        array(
            'class'    => 'change-pagesize',
            'onchange' => "$.fn.yiiGridView.update('route-grid',{data:{pageSize:$(this).val()}});",
        )
    );
    ?>
    <div class="page-size-wrap">
        <span>Display by:</span><?= $pageSizeDropDown; ?>
    </div>
    <?php Yii::app()->clientScript->registerCss( 'initPageSizeCSS', '.page-size-wrap{text-align: right;}' ); ?>

    <?php $this->widget('bootstrap.widgets.TbGridView',array(
        'id'=>'route-grid',
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'columns'=>array(
            'id',
            'route_name',
            'distance_km',
            'created_by',
            'created_date',
            array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'header'=>'<a>Actions</a>',
                'template' => '{view}{assign}',
                'buttons' => array(
                    'view' => array(
                        'label'=> 'View',
                        'options'=>array(
                            'class'=>'btn btn-small view'
                        )
                    ),
//            'update' => array(
//                'label'=> 'Update',
//                'options'=>array(
//                    'class'=>'btn btn-small update'
//                )
//            ),
                    /*'delete' => array(
                        'label'=> 'Delete',
                        'options'=>array(
                            'class'=>'btn btn-small delete'
                        )
                    ),*/
                    'assign'=>array(
                        'label'=>'Bus Inside Route',
                        'icon' => 'icon-edit',

                        'url'=>'Yii::app()->controller->createUrl("BusInsideRoute/Create",array("id"=>$data->id))',
                        'options'=>array(
                            'class'=>'btn btn-small'
                        ),
                    ),
                ),
                'htmlOptions'=>array('nowrap'=>'nowrap'),
            ),
        ),
    )); }elseif($mod == 'dbq'){
    ?>
    <div class="title"><h5>Manage Daily Bus Queue</h5></div>
    <?php
    $pageSize = Yii::app()->user->getState( 'pageSize', Yii::app()->params[ 'defaultPageSize' ] );
    $pageSizeDropDown = CHtml::dropDownList(
        'pageSize',
        $pageSize,
        array( 10 => 10, 25 => 25, 50 => 50, 100 => 100 ),
        array(
            'class'    => 'change-pagesize',
            'onchange' => "$.fn.yiiGridView.update('route-grid',{data:{pageSize:$(this).val()}});",
        )
    );
    ?>
    <div class="page-size-wrap">
        <span>Display by:</span><?= $pageSizeDropDown; ?>
    </div>
    <?php Yii::app()->clientScript->registerCss( 'initPageSizeCSS', '.page-size-wrap{text-align: right;}' ); ?>

    <?php $this->widget('bootstrap.widgets.TbGridView',array(
        'id'=>'route-grid',
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'columns'=>array(
            'id',
            'route_name',
            'distance_km',
            'created_by',
            'created_date',
            array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'header'=>'<a>Actions</a>',
                'template' => '{view}{assign}',
                'buttons' => array(
                    'view' => array(
                        'label'=> 'View',
                        'options'=>array(
                            'class'=>'btn btn-small view'
                        )
                    ),
//            'update' => array(
//                'label'=> 'Update',
//                'options'=>array(
//                    'class'=>'btn btn-small update'
//                )
//            ),
                    /*'delete' => array(
                        'label'=> 'Delete',
                        'options'=>array(
                            'class'=>'btn btn-small delete'
                        )
                    ),*/
                    'assign'=>array(
                        'label'=>'Daily Bus Queue',
                        'icon' => 'icon-edit',

                        'url'=>'Yii::app()->controller->createUrl("DailyBusQueue/Create",array("id"=>$data->id))',
                        'options'=>array(
                            'class'=>'btn btn-small'
                        ),
                    ),
                ),
                'htmlOptions'=>array('nowrap'=>'nowrap'),
            ),
        ),
    )); }?>
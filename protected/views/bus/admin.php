<?php
$this->breadcrumbs=array(
    'Buses'=>array('index'),
    'Manage',
);

$this->menu=array(
    array('label'=>'List Bus','url'=>array('index')),
    array('label'=>'Create Bus','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('bus-grid', {
data: $(this).serialize()
});
return false;
});
");
$mod = $_GET['mod'];
?>
<?php if($mod=="ccc"){?>
    <div class="title"><h5>Select Bus For Cost Configuration</div><h5>
    <?php
    $pageSize = Yii::app()->user->getState( 'pageSize', Yii::app()->params[ 'defaultPageSize' ] );
    $pageSizeDropDown = CHtml::dropDownList(
        'pageSize',
        $pageSize,
        array( 10 => 10, 25 => 25, 50 => 50, 100 => 100 ),
        array(
            'class'    => 'change-pagesize',
            'onchange' => "$.fn.yiiGridView.update('bus-grid',{data:{pageSize:$(this).val()}});",
        )
    );
    ?>
    <div class="page-size-wrap">
        <span>Display by:</span><?= $pageSizeDropDown; ?>
    </div>
    <?php Yii::app()->clientScript->registerCss( 'initPageSizeCSS', '.page-size-wrap{text-align: right;}' ); ?>

    <?php $this->widget('bootstrap.widgets.TbGridView',array(
        'id'=>'bus-grid',
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'columns'=>array(
//            'id',
            'bus_no',
            'chhachis_no',
//            'owned_date',
            'model_no',
//            'total_seat',
            'engine_no',
            'registered_date',
            /*
            'chhachis_no',
            'company',
            'registered_date',
            'created_date',
            'created_by',
            */
            array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'header'=>'<a>Actions</a>',
                'template' => '{view} {update} {assign}',
                'buttons' => array(
                    'view' => array(
                        'label'=> 'View',
                        'options'=>array(
                            'class'=>'btn btn-small view'
                        )
                    ),
                    'update' => array(
                        'label'=> 'Update',
                        'options'=>array(
                            'class'=>'btn btn-small update'
                        )
                    ),
                    /*'delete' => array(
                        'label'=> 'Delete',
                        'options'=>array(
                            'class'=>'btn btn-small delete'
                        )
                    ),*/
                    'assign'=>array(
                        'label'=>'Check',
                        'icon' => 'edit',
//                        'url'=>'Yii::app()->controller->createUrl("CheckedCostConfiguration/Create",array("id"=>$data->id))',
                        'url'=>'Yii::app()->controller->createUrl("CheckedCostConfiguration/create",array("id"=>$data->id))',
                        'options'=>array(
                            'class'=>'btn btn-small'
                        ),
                    ),
                ),
                'htmlOptions'=>array('nowrap'=>'nowrap'),
            ),
        ),
    )); }?>
<?php if($mod=="oh"){?>
    <div class="title"><h5>Choose To View Owner History</div><h5>
    <?php
    $pageSize = Yii::app()->user->getState( 'pageSize', Yii::app()->params[ 'defaultPageSize' ] );
    $pageSizeDropDown = CHtml::dropDownList(
        'pageSize',
        $pageSize,
        array( 10 => 10, 25 => 25, 50 => 50, 100 => 100 ),
        array(
            'class'    => 'change-pagesize',
            'onchange' => "$.fn.yiiGridView.update('bus-grid',{data:{pageSize:$(this).val()}});",
        )
    );
    ?>
    <div class="page-size-wrap">
        <span>Display by:</span><?= $pageSizeDropDown; ?>
    </div>
    <?php Yii::app()->clientScript->registerCss( 'initPageSizeCSS', '.page-size-wrap{text-align: right;}' ); ?>


    <?php $this->widget('bootstrap.widgets.TbGridView',array(
        'id'=>'bus-grid',
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'columns'=>array(
//            'id',
            'bus_no',
            'chhachis_no',
//            'owned_date',
            'model_no',
//            'total_seat',
            'engine_no',
            'registered_date',
            /*
            'chhachis_no',
            'company',
            'registered_date',
            'created_date',
            'created_by',
            */
            array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'header'=>'<a>Actions</a>',
                'template' => '{view} {update} {assign}',
                'buttons' => array(
                    'view' => array(
                        'label'=> 'View',
                        'options'=>array(
                            'class'=>'btn btn-small view'
                        )
                    ),
                    'update' => array(
                        'label'=> 'Update',
                        'options'=>array(
                            'class'=>'btn btn-small update'
                        )
                    ),
                    /*'delete' => array(
                        'label'=> 'Delete',
                        'options'=>array(
                            'class'=>'btn btn-small delete'
                        )
                    ),*/
                    'assign'=>array(
                        'label'=>'History',
                        'icon' => 'edit',

                        'url'=>'Yii::app()->controller->createUrl("Bus/History",array("id"=>$data->id))',
                        'options'=>array(
                            'class'=>'btn btn-small'
                        ),
                    ),
                ),
                'htmlOptions'=>array('nowrap'=>'nowrap'),
            ),
        ),
    )); }?>
<?php if($mod=="ins"){?>
    <div class="title"><h5>Choose For Bus Insurance</div><h5>

    <?php
    $pageSize = Yii::app()->user->getState( 'pageSize', Yii::app()->params[ 'defaultPageSize' ] );
    $pageSizeDropDown = CHtml::dropDownList(
        'pageSize',
        $pageSize,
        array( 10 => 10, 25 => 25, 50 => 50, 100 => 100 ),
        array(
            'class'    => 'change-pagesize',
            'onchange' => "$.fn.yiiGridView.update('bus-grid',{data:{pageSize:$(this).val()}});",
        )
    );
    ?>
    <div class="page-size-wrap">
        <span>Display by:</span><?= $pageSizeDropDown; ?>
    </div>
    <?php Yii::app()->clientScript->registerCss( 'initPageSizeCSS', '.page-size-wrap{text-align: right;}' ); ?>

    <?php $this->widget('bootstrap.widgets.TbGridView',array(
        'id'=>'bus-grid',
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'columns'=>array(
//            'id',
            'bus_no',
            'chhachis_no',
            //            'owned_date',
            'model_no',
//            'total_seat',
            'engine_no',
            'registered_date',
            /*
            'chhachis_no',
            'company',
            'registered_date',
            'created_date',
            'created_by',
            */
            array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'header'=>'<a>Actions</a>',
                'template' => '{view} {update} {assign}',
                'buttons' => array(
                    'view' => array(
                        'label'=> 'View',
                        'options'=>array(
                            'class'=>'btn btn-small view'
                        )
                    ),
                    'update' => array(
                        'label'=> 'Update',
                        'options'=>array(
                            'class'=>'btn btn-small update'
                        )
                    ),
                    /*'delete' => array(
                        'label'=> 'Delete',
                        'options'=>array(
                            'class'=>'btn btn-small delete'
                        )
                    ),*/
                    'assign'=>array(
                        'label'=>'Insurance',
                        'icon' => 'edit',

                        'url'=>'Yii::app()->controller->createUrl("BusInsurance/Create",array("id"=>$data->id))',
                        'options'=>array(
                            'class'=>'btn btn-small'
                        ),
                    ),
                ),
                'htmlOptions'=>array('nowrap'=>'nowrap'),
            ),
        ),
    )); }?>
<?php if($mod=="exp"){
    ?>

    <div class="title"><h5>Insurance Expired Bus List</div><h5>
    <?php
    $pageSize = Yii::app()->user->getState( 'pageSize', Yii::app()->params[ 'defaultPageSize' ] );
    $pageSizeDropDown = CHtml::dropDownList(
        'pageSize',
        $pageSize,
        array( 10 => 10, 25 => 25, 50 => 50, 100 => 100 ),
        array(
            'class'    => 'change-pagesize',
            'onchange' => "$.fn.yiiGridView.update('bus-grid',{data:{pageSize:$(this).val()}});",
        )
    );
    ?>
    <div class="page-size-wrap">
        <span>Display by:</span><?= $pageSizeDropDown; ?>
    </div>
    <?php Yii::app()->clientScript->registerCss( 'initPageSizeCSS', '.page-size-wrap{text-align: right;}' ); ?>


    <?php
        $this->widget('bootstrap.widgets.TbGridView', array(
        'id'=>'bus-grid',
        'dataProvider'=>$model->searchExpiredOnly(),

        'filter'=>$model,
        'columns'=>array(
//            'id',
            'bus_no',
            'chhachis_no',
            //            'owned_date',
            'model_no',
//            'total_seat',
            'engine_no',
            'registered_date',
            /*
            'chhachis_no',
            'company',
            'registered_date',
            'created_date',
            'created_by',
            */
            array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'header'=>'<a>Actions</a>',
                'template' => '{view} {update} {delete} {assign}',
                'buttons' => array(
                    'view' => array(
                        'label'=> 'View',
                        'options'=>array(
                            'class'=>'btn btn-small view'
                        )
                    ),
                    'update' => array(
                        'label'=> 'Update',
                        'options'=>array(
                            'class'=>'btn btn-small update'
                        )
                    ),
                    'delete' => array(
                        'label'=> 'Delete',
                        'options'=>array(
                            'class'=>'btn btn-small delete'
                        )
                    ),
                    'assign'=>array(
                        'label'=>'insurance',
                        'icon' => 'edit',

                        'url'=>'Yii::app()->controller->createUrl("BusInsurance/Create",array("id"=>$data->id))',
                        'options'=>array(
                            'class'=>'btn btn-small'
                        ),
                    ),
                ),
                'htmlOptions'=>array('nowrap'=>'nowrap'),
            ),
        ),
    ));
}?>
<?php if($mod=="up"){
    ?>
    <?php
    $this->widget(
        'bootstrap.widgets.TbTabs',
        array(
            'type' => 'tabs', // 'tabs' or 'pills'
            'tabs' => array(
                array('label'=>'Add New', 'url'=>array('/bus/create')),
            ),
        )
    );
    ?>
    <div class="title"><h5>Manage Bus</div><h5>
        <?php
        $pageSize = Yii::app()->user->getState( 'pageSize', Yii::app()->params[ 'defaultPageSize' ] );
        $pageSizeDropDown = CHtml::dropDownList(
            'pageSize',
            $pageSize,
            array( 10 => 10, 25 => 25, 50 => 50, 100 => 100 ),
            array(
                'class'    => 'change-pagesize',
                'onchange' => "$.fn.yiiGridView.update('bus-grid',{data:{pageSize:$(this).val()}});",
            )
        );
        ?>
        <div class="page-size-wrap">
            <span>Display by:</span><?= $pageSizeDropDown; ?>
        </div>
        <?php Yii::app()->clientScript->registerCss( 'initPageSizeCSS', '.page-size-wrap{text-align: right;}' ); ?>


    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'id'=>'bus-grid',
        'dataProvider'=>$model->search(),

        'filter'=>$model,
        'columns'=>array(
//            'id',
            'bus_no',
            'chhachis_no',
            //            'owned_date',
            'model_no',
//            'total_seat',
            'engine_no',
            'registered_date',
            /*
            'chhachis_no',
            'company',
            'registered_date',
            'created_date',
            'created_by',
            */
            array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'header'=>'<a>Actions</a>',
                'template' => '{view} {update}',
                'buttons' => array(
                    'view' => array(
                        'label'=> 'View',
                        'options'=>array(
                            'class'=>'btn btn-small view'
                        )
                    ),
                    'update' => array(
                        'label'=> 'Update',
                        'options'=>array(
                            'class'=>'btn btn-small update'
                        )
                    ),
                    /*'delete' => array(
                        'label'=> 'Delete',
                        'options'=>array(
                            'class'=>'btn btn-small delete'
                        )
                    ),*/
                ),
                'htmlOptions'=>array('nowrap'=>'nowrap'),
            ),
        ),
    ));
}?>
<?php if($mod=="res"){
    ?>
    <?php
    $this->widget(
        'bootstrap.widgets.TbTabs',
        array(
            'type' => 'tabs', // 'tabs' or 'pills'
            'tabs' => array(
                array('label'=>'Add New', 'url'=>array('/bus/create')),
            ),
        )
    );
    ?>
    <div class="title"><h5>Select Bus for Reserve</div><h5>

            <?php
            $pageSize = Yii::app()->user->getState( 'pageSize', Yii::app()->params[ 'defaultPageSize' ] );
            $pageSizeDropDown = CHtml::dropDownList(
                'pageSize',
                $pageSize,
                array( 10 => 10, 25 => 25, 50 => 50, 100 => 100 ),
                array(
                    'class'    => 'change-pagesize',
                    'onchange' => "$.fn.yiiGridView.update('bus-grid',{data:{pageSize:$(this).val()}});",
                )
            );
            ?>
            <div class="page-size-wrap">
                <span>Display by:</span><?= $pageSizeDropDown; ?>
            </div>
            <?php Yii::app()->clientScript->registerCss( 'initPageSizeCSS', '.page-size-wrap{text-align: right;}' ); ?>

    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'id'=>'bus-grid',
        'dataProvider'=>$model->search(),

        'filter'=>$model,
        'columns'=>array(
//            'id',
            'bus_no',
            'chhachis_no',
            //            'owned_date',
            'model_no',
//            'total_seat',
            'engine_no',
            'registered_date',
            /*
            'chhachis_no',
            'company',
            'registered_date',
            'created_date',
            'created_by',
            */
            array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'header'=>'<a>Actions</a>',
                'template' => '{view} {update} {assign}',
                'buttons' => array(
                    'view' => array(
                        'label'=> 'View',
                        'options'=>array(
                            'class'=>'btn btn-small view'
                        )
                    ),
                    'update' => array(
                        'label'=> 'Update Bus Info',
                        'options'=>array(
                            'class'=>'btn btn-small update'
                        )
                    ),
                    'assign'=>array(
                        'label'=>'Reserve',
                        'icon' => 'edit',

                        'url'=>'Yii::app()->controller->createUrl("Reserve/Create",array("id"=>$data->id))',
                        'options'=>array(
                            'class'=>'btn btn-small'
                        ),
                    ),
                    /*'delete' => array(
                        'label'=> 'Delete',
                        'options'=>array(
                            'class'=>'btn btn-small delete'
                        )
                    ),*/
                ),
                'htmlOptions'=>array('nowrap'=>'nowrap'),
            ),
        ),
    ));
}?>

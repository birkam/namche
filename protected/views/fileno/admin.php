<?php
$this->breadcrumbs=array(
    'File Nos'=>array('index'),
    'Manage',
);

$this->menu=array(
    array('label'=>'List FileNo','url'=>array('index')),
    array('label'=>'Create FileNo','url'=>array('create')),
);


$mod=$_GET['mod'];
?>
<?php
$this->widget('bootstrap.widgets.TbAlert', array(
    'fade' => true,
    'closeText' => '&times;', // false equals no close link
    'events' => array(),
    'htmlOptions' => array(),
    'userComponentId' => 'user',
    'alerts' => array( // configurations per alert type
        // success, info, warning, error or danger
        'success' => array('closeText' => '&times;'),
        'info', // you don't need to specify full config
        'warning' => array('closeText' => false),
        'error' => array('closeText' => '')
    ),
));
?>
<?php if($mod=="otf"){?>
    <div class="title"> <h5>Manage File No(assign owner to file no)</h5></div>
    <?php
    $pageSize = Yii::app()->user->getState( 'pageSize', Yii::app()->params[ 'defaultPageSize' ] );
    $pageSizeDropDown = CHtml::dropDownList(
        'pageSize',
        $pageSize,
        array( 10 => 10, 25 => 25, 50 => 50, 100 => 100 ),
        array(
            'class'    => 'change-pagesize',
            'onchange' => "$.fn.yiiGridView.update('file-no-grid',{data:{pageSize:$(this).val()}});",
        )
    );
    ?>
    <div class="page-size-wrap">
        <span>Display by:</span><?= $pageSizeDropDown; ?>
    </div>
    <?php Yii::app()->clientScript->registerCss( 'initPageSizeCSS', '.page-size-wrap{text-align: right;}' ); ?>

    <?php $this->widget('bootstrap.widgets.TbGridView',array(
        'id'=>'file-no-grid',
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'columns'=>array(
//            'id',
            'file_no',
            array( 'name'=>'createdBy', 'value'=>'$data->file? $data->file->user_name: "-"' ),
//            'created_by',
            'created_date',
            array(
                'header'=>'Bus',
                'value'=>'$data->busId()',
            ),
            array(
                'header'=>'Owner',
                'value'=>'$data->ownerId()',
            ),
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
                        'label'=>'Assign Owner',
                        'icon' => 'icon-edit',

                        'url'=>'Yii::app()->controller->createUrl("FilenoBus/Create",array("id"=>$data->id))',
                        'options'=>array(
                            'class'=>'btn btn-small'
                        ),
                    ),
                ),
                'htmlOptions'=>array('nowrap'=>'nowrap'),
            ),
        ),
    )); }?>
<?php if($mod=="btf"){?>
    <div class="title"> <h5>Manage File No(assign bus inside file no)</h5></div>
    <?php
    $pageSize = Yii::app()->user->getState( 'pageSize', Yii::app()->params[ 'defaultPageSize' ] );
    $pageSizeDropDown = CHtml::dropDownList(
        'pageSize',
        $pageSize,
        array( 10 => 10, 25 => 25, 50 => 50, 100 => 100 ),
        array(
            'class'    => 'change-pagesize',
            'onchange' => "$.fn.yiiGridView.update('file-no-grid',{data:{pageSize:$(this).val()}});",
        )
    );
    ?>
    <div class="page-size-wrap">
        <span>Display by:</span><?= $pageSizeDropDown; ?>
    </div>
    <?php Yii::app()->clientScript->registerCss( 'initPageSizeCSS', '.page-size-wrap{text-align: right;}' ); ?>

    <?php $this->widget('bootstrap.widgets.TbGridView',array(
        'id'=>'file-no-grid',
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'columns'=>array(
//            'id',
            'file_no',
            array( 'name'=>'createdBy', 'value'=>'$data->file? $data->file->user_name: "-"' ),
//            'created_by',
            'created_date',
            array(
                'header'=>'Bus',
                'value'=>'$data->busId()',
            ),
            array(
                'header'=>'Owner',
                'value'=>'$data->ownerId()',
            ),

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
                        'label'=>'Assign Bus',
                        'icon' => 'icon-edit',

                        'url'=>'Yii::app()->controller->createUrl("FileAssignbus/Create",array("id"=>$data->id))',
                        'options'=>array(
                            'class'=>'btn btn-small'
                        ),
                    ),
                ),
                'htmlOptions'=>array('nowrap'=>'nowrap'),
            ),
        ),
    )); }?>
<?php if($mod=="fbo"){?>
    <div class="title"> <h5>FILE BUS OWNER</h5></div>
    <?php
    $pageSize = Yii::app()->user->getState( 'pageSize', Yii::app()->params[ 'defaultPageSize' ] );
    $pageSizeDropDown = CHtml::dropDownList(
        'pageSize',
        $pageSize,
        array( 10 => 10, 25 => 25, 50 => 50, 100 => 100 ),
        array(
            'class'    => 'change-pagesize',
            'onchange' => "$.fn.yiiGridView.update('file-no-grid',{data:{pageSize:$(this).val()}});",
        )
    );
    ?>
    <div class="page-size-wrap">
        <span>Display by:</span><?= $pageSizeDropDown; ?>
    </div>
    <?php Yii::app()->clientScript->registerCss( 'initPageSizeCSS', '.page-size-wrap{text-align: right;}' ); ?>

    <?php $this->widget('bootstrap.widgets.TbGridView',array(
        'id'=>'file-no-grid',
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'columns'=>array(
//            'id',
            'file_no',
            array( 'name'=>'createdBy', 'value'=>'$data->file? $data->file->user_name: "-"' ),
//            'created_by',
            'created_date',
            array(
                'header'=>'Bus',
                'value'=>'$data->busId()',
            ),
            array(
                'header'=>'Owner',
                'value'=>'$data->ownerId()',
            ),
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
                        'label'=>'Assign Bus',
                        'icon' => 'icon-edit',

                        'url'=>'Yii::app()->controller->createUrl("FileBusOwner/Create",array("id"=>$data->id))',
                        'options'=>array(
                            'class'=>'btn btn-small'
                        ),
                    ),
                ),
                'htmlOptions'=>array('nowrap'=>'nowrap'),
            ),
        ),
    )); }?>
<?php if($mod=="ohuf"){?>
    <div class="title"> <h5>OWNER HISTORY UNDER FILE NO</h5></div>
    <?php
    $pageSize = Yii::app()->user->getState( 'pageSize', Yii::app()->params[ 'defaultPageSize' ] );
    $pageSizeDropDown = CHtml::dropDownList(
        'pageSize',
        $pageSize,
        array( 10 => 10, 25 => 25, 50 => 50, 100 => 100 ),
        array(
            'class'    => 'change-pagesize',
            'onchange' => "$.fn.yiiGridView.update('file-no-grid',{data:{pageSize:$(this).val()}});",
        )
    );
    ?>
    <div class="page-size-wrap">
        <span>Display by:</span><?= $pageSizeDropDown; ?>
    </div>
    <?php Yii::app()->clientScript->registerCss( 'initPageSizeCSS', '.page-size-wrap{text-align: right;}' ); ?>

    <?php $this->widget('bootstrap.widgets.TbGridView',array(
        'id'=>'file-no-grid',
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'columns'=>array(
//            'id',
            'file_no',
            array(
                'header'=>'Bus',
                'value'=>'$data->busId()',
            ),
            array(
                'header'=>'Owner',
                'value'=>'$data->ownerId()',
            ),
            array( 'name'=>'createdBy', 'value'=>'$data->file? $data->file->user_name: "-"' ),
//            'created_by',
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
                        'label'=>'Assign Bus',
                        'icon' => 'icon-edit',

                        'url'=>'Yii::app()->controller->createUrl("FileNo/SingleFileOwnerHistory",array("id"=>$data->id))',
                        'options'=>array(
                            'class'=>'btn btn-small'
                        ),
                    ),
                ),
                'htmlOptions'=>array('nowrap'=>'nowrap'),
            ),
        ),
    )); }?>

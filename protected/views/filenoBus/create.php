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
<?php $filenoid = $_GET['id'];
$filenovalue = FileNo::model()->findByPk($filenoid);
if(!empty($filenovalue)){
    $fileno = $filenovalue->file_no;
}
?>
<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('fileno-bus-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="title"> <h5>Manage Owners of File No ::<?php echo $fileno;?>::</h5></div>

<?php

$filter = array('1' => 'Primary', '2' => 'Secondary');
$stat = array('1' => 'Active', '0' => 'Not Active');
$this->widget('bootstrap.widgets.TbGridView',array(
    'id'=>'fileno-bus-grid',
    'dataProvider'=>$modelsearch->search($modelsearch->fileno_id=$fileno),
    'filter'=>$modelsearch,
    'columns'=>array(
//        'id',
//        'fileno_id',
//        'owner_id',
        array( 'name'=>'owner_fname', 'value'=>'$data->fnb? $data->fnb->fname: "-"' ),
        array( 'name'=>'owner_mname', 'value'=>'$data->fnb? $data->fnb->mname: "-"' ),
        array( 'name'=>'owner_lname', 'value'=>'$data->fnb? $data->fnb->lname: "-"' ),
        array(
            'name' => 'owner_type',
            'value' => 'FilenoBus::checkType($data->owner_type)',
            'filter' => $filter,
        ),
        array(
            'name' => 'owner_status',
            'value' => 'FilenoBus::checkStat($data->owner_status)',
            'filter' => $stat,
        ),
        'owned_date',
        'left_date',
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
//                'update' => array(
//                    'label'=> 'Update',
//                    'options'=>array(
//                        'class'=>'btn btn-small update'
//                    )
//                ),
            ),
            'htmlOptions'=>array('nowrap'=>'nowrap'),
        ),
    ),
)); ?>

<?php
$this->breadcrumbs=array(
    'Fileno Buses'=>array('index'),
    'Create',
);

$this->menu=array(
    array('label'=>'List FilenoBus','url'=>array('index')),
    array('label'=>'Manage FilenoBus','url'=>array('admin')),
);
?>

<h1>Assign Bus Owner to File No <?php echo $fileno;?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>


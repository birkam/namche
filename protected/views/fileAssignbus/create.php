<?php
$this->breadcrumbs=array(
	'File Assignbuses'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List FileAssignbus','url'=>array('index')),
array('label'=>'Manage FileAssignbus','url'=>array('admin')),
);
?>
<?php
$filenovalue = FileNo::model()->findByPk($fileId);
if(!empty($filenovalue)){
    $fileno = $filenovalue->file_no;
}
$owner_id_arr = explode(', ', $owner_id_str);
echo 'Active Owners Under =';
foreach($owner_id_arr as $val){
    $owners = BusOwner::model()->findByPk($val);
    echo ucwords(strtolower($owners->fname.' '.$owners->mname.' '.$owners->lname.', '));
}
?>

<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('file-assignbus-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

    <h1>Bus Under File No. <?php echo $fileno;?></h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id'=>'file-assignbus-grid',
    'dataProvider'=>$modelsearch->search($modelsearch->fileno_id=$fileno),
    'filter'=>$modelsearch,
    'columns'=>array(
//        'id',
//        'fileno_id',
//        'bus_id',
        array( 'name'=>'bus_number', 'value'=>'$data->bus? $data->bus->bus_no: "-"' ),
        'bus_status',
//        'created_by',
        'bus_entered_date',
        'taken_out_date',
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

<h1>Assign Bus Under File No. <?php echo $fileno;?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'fileId'=>$fileId, 'owner_id_str'=>$owner_id_str)); ?>
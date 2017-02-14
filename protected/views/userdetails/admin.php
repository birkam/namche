<?php
$this->breadcrumbs=array(
    'User Details'=>array('index'),
    'Manage',
);

$this->menu=array(
    array('label'=>'List UserDetails','url'=>array('index')),
    array('label'=>'Create UserDetails','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('user-details-grid', {
data: $(this).serialize()
});
return false;
});
");
?>


<div class="title"><h5>User Management</h5></div>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id'=>'user-details-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'id',
        'name',
        'address',
        'email',
        'phone',
        'mobile',
        /*
'academic_qualification',
'professional_qualification',
'enrolled_date',
'created_by',
'created_date',
*/
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'header'=>'<a>Actions</a>',
            'template' => '{view} {update} {assign}',
            'buttons' => array(
                'view' => array(
                    'label'=> 'View',
                    'url'=>'Yii::app()->controller->createUrl("UserDetails/View",array("id"=>$data->id, "ref"=>"gd"))',
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
                    'label'=>'Assign User Account',
                    'icon' => 'user',

                    'url'=>'Yii::app()->controller->createUrl("UserAccount/create",array("id"=>$data->id))',
                    'options'=>array(
                        'class'=>'btn btn-small'
                    ),
                ),
            ),
            'htmlOptions'=>array('nowrap'=>'nowrap'),
        ),
    ),
)); ?>

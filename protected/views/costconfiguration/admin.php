<?php
$this->breadcrumbs=array(
    'Cost Configurations'=>array('index'),
    'Manage',
);

$this->menu=array(
    array('label'=>'List CostConfiguration','url'=>array('index')),
    array('label'=>'Create CostConfiguration','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('cost-configuration-grid', {
data: $(this).serialize()
});
return false;
});
");
?>
<?php
$this->widget(
    'bootstrap.widgets.TbTabs',
    array(
        'type' => 'tabs', // 'tabs' or 'pills'
        'tabs' => array(
            array('label'=>'Manage', 'url'=>array('admin')),
            array('label'=>'Add', 'url'=>array('create')),
        ),
    )
);
?>
<h1>Manage Cost Configurations</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id'=>'cost-configuration-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'id',
        'particular',
        'rate',
        'created_by',
        'created_date',
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template' => '{view} {update}',
        ),
    ),
)); ?>

<?php
$this->breadcrumbs=array(
	'Cost Configurations'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

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
	<h1>Update CostConfiguration <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
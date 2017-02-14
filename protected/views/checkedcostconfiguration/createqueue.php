<?php
$this->breadcrumbs=array(
    'Checked Cost Configurations'=>array('index'),
    'Create',
);

$this->menu=array(
    array('label'=>'List CheckedCostConfiguration','url'=>array('index')),
    array('label'=>'Manage CheckedCostConfiguration','url'=>array('admin')),
);
?>

    <h1>Create Checked Cost Configuration</h1>

<?php echo $this->renderPartial('_formqueue', array('model'=>$model, 'other'=>$other, 'routeCost'=>$routeCost)); ?>
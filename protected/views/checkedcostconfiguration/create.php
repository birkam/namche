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

<?php
if($rid == null or $dbq_id == null){
    echo $this->renderPartial('_form', array('model'=>$model, 'other'=>$other, 'rid'=>$rid, 'dbq_id'=>$dbq_id));
}else{
    echo $this->renderPartial('_form', array('model'=>$model, 'other'=>$other, 'rid'=>$rid, 'dbq_id'=>$dbq_id, 'routeCost'=>$routeCost,'pt'=>$pt));
}?>
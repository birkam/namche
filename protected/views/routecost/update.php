<?php
/* @var $this RouteCostController */
/* @var $model RouteCost */

$this->breadcrumbs=array(
    'Route Costs'=>array('index'),
    $model->id=>array('view','id'=>$model->id),
    'Update',
);

$this->menu=array(
    array('label'=>'List RouteCost', 'url'=>array('index')),
    array('label'=>'Create RouteCost', 'url'=>array('create')),
    array('label'=>'View RouteCost', 'url'=>array('view', 'id'=>$model->id)),
    array('label'=>'Manage RouteCost', 'url'=>array('admin')),
);
$route = Route::model()->findByPk($model->route_id);
if(empty($route)){
    ?>
    <div class="alert in alert-block fade alert-error"><a href="#" class="close" data-dismiss="alert"></a><strong>Could Not Find Such Route !!!</strong></div>
    <?php  die(); }?>
    <div class="title"><h5>Update Route Costs ::<?php echo strtoupper($route->route_name); ?>::</h5></div>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>
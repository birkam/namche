<?php
$this->breadcrumbs=array(
    'Buses'=>array('index'),
    $model->id,
);

$this->menu=array(
    array('label'=>'List Bus','url'=>array('index')),
    array('label'=>'Create Bus','url'=>array('create')),
    array('label'=>'Update Bus','url'=>array('update','id'=>$model->id)),
    array('label'=>'Delete Bus','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('label'=>'Manage Bus','url'=>array('admin')),
);
?>
<?php
$this->widget(
    'bootstrap.widgets.TbTabs',
    array(
        'type' => 'tabs', // 'tabs' or 'pills'
        'tabs' => array(
            array('label'=>'Add New', 'url'=>array('/bus/create')),
            array('label'=>'Manage', 'url'=>array('/bus/admin?mod=up')),
            array('label'=>'Update', 'url'=>array('/bus/update/'.$model->id)),
        ),
    )
);
?>

<div class="widget first">
    <div class="title"><h5 class="iPreview" style="padding-left: 35px;">View Bus <?php echo $model->bus_no; ?></h5></div>
    <!--    <div class="head"><h5 class="iPreview">View Bus --><?php //echo $model->bus_no; ?><!--</h5></div>-->
    <br><br>
    <div class=" row span12">
        <div class=" span3 view">
            <h5>Bus no : <?php echo $model->bus_no; ?></h5>
        </div>
        <div class=" span3 view">
            <h5>Owned Date : <?php echo $model->owned_date; ?></h5>
        </div>
    </div>
    <div class="fix"></div>
    <br><br>
    <div class="  row span12">
        <div class=" span3 view">
            <h5>Model No : <?php echo $model->model_no; ?></h5>
        </div>
        <div class=" span3 view">
            <h5>Total Seat : <?php echo $model->total_seat; ?></h5>
        </div>
        <div class=" span3 view">
            <h5>Engine No : <?php echo $model->engine_no; ?></h5>
        </div>
    </div>
    <div class="fix"></div>
    <br><br>
    <div class="row span12">
        <div class=" span3 view">
            <h5>Chhachis No : <?php echo $model->chhachis_no; ?></h5>
        </div>
        <div class=" span3 view">
            <h5>Company : <?php echo $model->company; ?></h5>
        </div>
        <div class=" span3 view">
            <h5>Registered Date : <?php echo $model->registered_date; ?></h5>
        </div>
    </div>
    <div class="fix"></div>
    <div class="row span12">
        <div class=" span9 view">
            <h5>Remarks : <?php echo $model->remarks; ?></h5>
        </div>
    </div>
    <div class="fix"></div>

    <br><br>
</div>




<?php
$this->breadcrumbs=array(
    'Bus Insurances'=>array('index'),
    $model->id,
);

$this->menu=array(
    array('label'=>'List BusInsurance','url'=>array('index')),
    array('label'=>'Create BusInsurance','url'=>array('create')),
    array('label'=>'Update BusInsurance','url'=>array('update','id'=>$model->id)),
    array('label'=>'Delete BusInsurance','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('label'=>'Manage BusInsurance','url'=>array('admin')),
);
?>

<h1>View BusInsurance #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
    'data'=>$model,
    'attributes'=>array(
        'id',
        'bus_id',
        'insurance_company',
        'insurance_account',
        'ac_holder_name',
        'tax_invoice_no',
        'police_no',
        'insured_amount',
        'agent_code',
        'issue_date',
        'expiry_date',
        'remarks',
        'created_by',
        'created_date',
    ),
)); ?>

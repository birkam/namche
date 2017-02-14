<?php
$this->breadcrumbs=array(
    'Bus And Drivers'=>array('index'),
    'Create',
);

$this->menu=array(
    array('label'=>'List BusAndDriver','url'=>array('index')),
    array('label'=>'Manage BusAndDriver','url'=>array('admin')),
);
?>
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
<?php
$thisBusDriver = BusAndDriver::model()->findByAttributes(array('bus_id'=>$bus_id, 'driver_status'=>1));
if(!empty($thisBusDriver)){
    $driver_id = $thisBusDriver->driver_id;
    $driverInfo = DriverInfo::model()->findByPk($driver_id);
    $driverName = $driverInfo->fname.' '.$driverInfo->mname.' '.$driverInfo->lname;
    $driverLicenceNo = $driverInfo->licence_no;
}else{
    $driverName = null;
    $driverLicenceNo = null;
}

/*if(empty($thisBusDriver)){
    echo 'This Bus Has No Driver';
}else{
    echo $thisBusDriver->driver_id;
}*/
//var_dump($thisBusDriver);
?>
    <div class="well">

        <div class="title"><h5>Current Bus Driver Informations</h5></div>

        <table>
            <?php if(!empty($thisBusDriver)){?>
                <tr>
                    <th>Driver Name:</th>
                    <td><?php echo ucwords(strtolower($driverName));?></td>
                </tr>
                <tr>
                    <th>Licence No:</th>
                    <td><?php echo ucwords(strtolower($driverLicenceNo));?></td>
                </tr>
            <?php }else{?>
                <tr>
                    <td>
                        Currently No Driver
                    </td>

                </tr>
            <?php }
            if(!empty($rid)){
                $route_details = Route::model()->findByPk($rid);
                ?>
                <tr>
                    <th>Route Name:</th>
                    <td><?php echo $route_details->route_name; ?></td>
                </tr>
            <?php }?>
        </table>
    </div>


    <div class="title"><h5>Assign Driver To Bus</h5></div>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'bus_id'=>$bus_id, 'driverName'=>$driverName, 'rid'=>$rid,'dbq_id'=>$dbq_id,
)); ?>
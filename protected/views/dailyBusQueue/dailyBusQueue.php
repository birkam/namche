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
/**
 * Created by PhpStorm.
 * User: SANIL
 * Date: 3/1/15
 * Time: 10:59 AM
 */
$id = $model->id;
$calendar = new DateConverter();
$engDate = date('Y-m-d', time());
if(!empty($engDate)){
    list($eDate, $emonth, $eday) =explode("-",$engDate);

    $cal = $calendar->eng_to_nep($eDate, $emonth, $eday);
    if(strlen($cal['date'])==2 && strlen($cal['month']) == 2){
        $nepali_date = $cal['year'] . '-' . $cal['month'] . '-' . $cal['date'];
    }elseif(strlen($cal['date'])==1 && strlen($cal['month']) == 2){
        $nepali_date = $cal['year'] . '-' . $cal['month'] . '-' .'0'. $cal['date'];
    }elseif(strlen($cal['date'])==2 && strlen($cal['month']) == 1){
        $nepali_date = $cal['year'] . '-' .'0'. $cal['month'] . '-' . $cal['date'];
    }elseif(strlen($cal['date'])==1 && strlen($cal['month']) == 1){
        $nepali_date = $cal['year'] . '-' .'0'. $cal['month'] . '-' .'0'. $cal['date'];
    }
}
$route_id = $model->route_id;
$queue_date = $model->queue_date;

$time_id = $model->time_id;
$time_id_arr = explode(', ', $time_id);

$bus_id = $model->bus_id;
$bus_id_arr = explode(', ', $bus_id);

$queue_serial = $model->queue_serial;
$queue_serial_arr = explode(',', $queue_serial);
$route_cost = RouteCost::model()->findByAttributes(array('route_id'=>$route_id, 'cost_status'=>1));
$allBusInQ_arr = array();
$allBusInQ = BusInsideRoute::model()->findAllByAttributes(array('route_id'=>$route_id,'bus_status'=>1));
foreach($allBusInQ as $allB){
    $allBusInQ_arr[$allB->bus_id] = $allB->bus_id;
}
$busNotInQueue =  array_diff($allBusInQ_arr, $bus_id_arr);
$bus_to_select = array();
if(!empty($busNotInQueue)){
    $replaceBus = Bus::model()->findAllByAttributes(array('id'=>@$busNotInQueue));
    foreach($replaceBus as $rB){
        $bus_to_select[$rB->id] = $rB->bus_no;
    }
}
?>
<?php
$sql = "SELECT route_name FROM tbl_route WHERE id= '$route_id' ";
$command = Yii::app()->db->createCommand($sql);
$route_name= $command->queryScalar();
//echo 'Route Cost = '.$route_cost->route_cost;
?>
<div class="widget first">
    <div class="head"><h5 class="iFrames">Cost Information of <a href="<?php echo Yii::app()->request->baseUrl.'/route/'.$route_id; ?>"><span style="color: #2b6893"><?php echo strtoupper($route_name); ?></span></a></h5></div>
    <table cellpadding="0" cellspacing="0" width="100%" class="tableStatic">
        <thead>
        <tr>
            <td width="7.69%">samiti_sulka</td>
            <td width="7.69%">bhalai_kosh</td>
            <td width="7.69%">samrakshan</td>
            <td width="7.69%">ticket</td>
            <td width="7.69%">sahayog</td>
            <td width="7.69%">bima</td>
            <td width="7.69%">bibidh</td>
            <td width="7.69%">mandir</td>
            <td width="7.69%">jokhim</td>
            <td width="7.69%">anugaman</td>
            <td width="7.69%">bi_bya_sulka</td>
            <td width="7.69%">ma_kosh</td>
            <td width="7.69%"><strong>Total</strong></td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?php echo $route_cost->samiti_sulka; ?></td>
            <td><?php echo $route_cost->bhalai_kosh; ?></td>
            <td><?php echo $route_cost->samrakshan; ?></td>
            <td><?php echo $route_cost->ticket; ?></td>
            <td><?php echo $route_cost->sahayog; ?></td>
            <td><?php echo $route_cost->bima; ?></td>
            <td><?php echo $route_cost->bibidh; ?></td>
            <td><?php echo $route_cost->mandir; ?></td>
            <td><?php echo $route_cost->jokhim; ?></td>
            <td><?php echo $route_cost->anugaman; ?></td>
            <td><?php echo $route_cost->bi_bya_sulka; ?></td>
            <td><?php echo $route_cost->ma_kosh; ?></td>
            <td><strong><?php echo $route_cost->samiti_sulka+$route_cost->bhalai_kosh+$route_cost->samrakshan+$route_cost->ticket+$route_cost->sahayog+$route_cost->bima+$route_cost->bibidh+$route_cost->mandir+$route_cost->jokhim+$route_cost->anugaman+$route_cost->bi_bya_sulka+$route_cost->ma_kosh ; ?></strong></td>
        </tr>
        </tbody>
    </table>
</div>

<div class="widget first">
    <div class="head"><h5 class="iFrames">Queue of <a href="<?php echo Yii::app()->request->baseUrl.'/route/'.$route_id; ?>"><span style="color: #2b6893"><?php echo strtoupper($route_name); ?></span></a></h5><div class="num">For Date <strong class="blueNum"><?php echo $queue_date?></strong></div></div>
    <table cellpadding="0" cellspacing="0" width="100%" class="tableStatic">
        <thead>
        <tr>
            <td>Time</td>
            <td>Bus No.</td>
            <td>Remove</td>
            <td>Payment</td>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach (array_keys($time_id_arr + $bus_id_arr + $queue_serial_arr) as $tb) {
            $routeTime = RouteTime::model()->findByPk($time_id_arr[$tb]);
            $busInfo = Bus::model()->findByPk($bus_id_arr[$tb]);
            $bus = $bus_id_arr[$tb];
            /*                                        foreach($time_id_arr as $time){
                                                        $routeTime = RouteTime::model()->findByPk($time);*/
            ?>
            <tr>
                <td><?php echo $routeTime->route_time; ?></td>
                <td><a href="<?php echo Yii::app()->request->baseUrl; ?>/Bus/<?php echo $bus; ?>"><?php echo $busInfo->bus_no; ?></a></td>
                <form action="<?php echo Yii::app()->request->baseUrl; ?>/DailyBusQueue/BusRemove" method="POST">
                    <td>
                        <?php
                        $payment_status_arr = explode(', ', $model->payment_status);
                        if(in_array($bus, $payment_status_arr)){ ?>
                            Paid Can't Remove
                        <?php }elseif($queue_date<$nepali_date){
                            echo 'Too late to remove.';
                        }else{ ?>
                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            <input type="hidden" name="bus_id" value="<?php echo $bus;?>">
                            <input type="hidden" name="queue_serial" value="<?php echo $queue_serial_arr[$tb];?>">
                            <input type="hidden" name="time_id" value="<?php echo $time_id_arr[$tb];?>">
                            <input type="submit" value="Remove" name="remove">
                        <?php } ?>
                    </td>
                </form>
                <form action="<?php echo Yii::app()->request->baseUrl; ?>/BusAndDriver/Create?id=<?php echo $bus;?>&dbq_id=<?php echo $id;?>&rid=<?php echo $route_id;?>&tid=<?php echo $time_id_arr[$tb];?>" method="POST">
                    <td>
                        <?php
                        $payment_status_arr = explode(', ', $model->payment_status);
                        if(in_array($bus, $payment_status_arr)){
                            $checked_route_cost = CheckedRouteCost::model()->findByAttributes(array('bus_id'=>$bus, 'route_id'=>$route_id, 'queue_date'=>$queue_date));
                            ?>
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/CheckedCostConfiguration/<?php echo $checked_route_cost->checked_cost_conf_id; ?>">Paid</a>
                        <?php }else{ ?>
                            <input type="submit" value="Pay" name="pay">
                        <?php } ?>

                    </td>
                </form>
            </tr>
        <?php  }?>
        </tbody>
    </table>
</div>
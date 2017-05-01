<?php
/**
 * Created by PhpStorm.
 * User: Hero
 * Date: 3/11/2017
 * Time: 4:26 PM
 */
?>
<style>
    .cross_1{
        text-decoration: line-through;
    }
    .cross_2{
        text-decoration: line-through;
        color: #ff0000;
    }
</style>
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

?>

<div class="widget first">
    <div class="head"><h5 class="iFrames">Cost Information of <a href="<?php echo Yii::app()->request->baseUrl.'/route/'.$model->route_id; ?>"><span style="color: #2b6893"><?php echo strtoupper($route_info->route_name); ?></span></a></h5></div>
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
    <div class="head"><h5 class="iFrames">Queue of <a href="<?php echo Yii::app()->request->baseUrl.'/route/'.$model->route_id; ?>"><span style="color: #2b6893"><?php echo strtoupper($route_info->route_name); ?></span></a></h5><div class="num">For Date <strong class="blueNum"><?php echo $model->queue_date?></strong></div></div>
    <table cellpadding="0" cellspacing="0" width="100%" class="tableStatic">
        <thead>
        <tr>
            <td>Time</td>
            <td>Bus No.</td>
            <td>Replace</td>
            <td>Payment</td>
            <td>Remarks</td>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($bus_queued as $bqd) {
            $routeTime = RouteTime::model()->findByPk($bqd->time_id);
            $busInfo = Bus::model()->findByPk($bqd->bus_id);
            if($bqd->bus_remove_type>0){//remove type => 1 = temp, 2=permanent
                $criteria=new CDbCriteria;
                $criteria->condition = 'daily_queued_bus_id=:daily_queued_bus_id and daily_bus_queue_id=:daily_bus_queue_id';
                $criteria->params = array('daily_queued_bus_id'=>$bqd->id, 'daily_bus_queue_id'=>$bqd->daily_bus_queue_id);
                $criteria->order = "id desc";
                $criteria->limit = 1;
                $removedbus = BusRemoveHistory::model()->find($criteria);
            }
            ?>
            <tr>
                <td><?php echo $routeTime->route_time; ?></td>
                <td>
                    <?php if($bqd->bus_remove_type>0){
                        $old_bus = Bus::model()->findByPk($removedbus->old_bus_id);
                        ?>
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/Bus/<?php echo $removedbus->old_bus_id; ?>" class="<?= 'cross_'.$bqd->bus_remove_type;?>"><?php echo $old_bus->bus_no; ?></a> /
                    <?php } ?>
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/Bus/<?php echo $bqd->bus_id; ?>"><?php echo $busInfo->bus_no; ?></a>
                </td>
                <form action="<?php echo Yii::app()->request->baseUrl; ?>/DailyBusQueue/BusRemove" method="POST">
                    <td>
                        <?php
                        if($bqd->payment_status==1){ ?>
                            Paid Can't Replaced
                        <?php }elseif($model->queue_date<$nepali_date){
                            echo 'Too late to replaced.';
                        }else{ ?>
                            <input type="hidden" name="id" value="<?php echo $model->id;?>" class="dbq_id">
                            <input type="hidden" name="dqb_id" value="<?php echo $bqd->id;?>" class="dqb_id">
                            <input type="hidden" name="bus_id" value="<?php echo $bqd->bus_id;?>">
                            <input type="hidden" name="queue_serial" value="<?php echo $bqd->queue_serial;?>">
                            <input type="hidden" name="time_id" value="<?php echo $bqd->time_id;?>">
                            <input type="button" value="Replace" name="replace" class="replace">
                        <?php } ?>
                    </td>
                </form>
                <form action="<?php echo Yii::app()->request->baseUrl; ?>/BusAndDriver/Create?id=<?php echo $bqd->bus_id;?>&dbq_id=<?php echo $model->id;?>&rid=<?php echo $model->route_id;?>&tid=<?php echo $bqd->time_id;?>" method="POST">
                    <td>
                        <?php
                        if($bqd->payment_status==1){
                            $checked_route_cost = CheckedRouteCost::model()->findByAttributes(array('bus_id'=>$bqd->bus_id, 'route_id'=>$model->route_id, 'queue_date'=>$model->queue_date));
                            ?>
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/CheckedCostConfiguration/<?php echo $checked_route_cost->checked_cost_conf_id; ?>">Paid</a>
                        <?php }else{ ?>
                            <input type="submit" value="Pay" name="pay">
                        <?php } ?>

                    </td>
                </form>
                <td>
                    <?php if($bqd->bus_remove_type>0){
                        echo  $removedbus->remarks;
                    } ?>
                </td>
            </tr>
        <?php  }?>
        </tbody>
    </table>
</div>
<div id="replaceModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Replace Bus</h3>
    </div>
    <div class="load-data">

    </div>
</div>
<script>
    $('.replace').on('click', function () {
//    $('#replaceModal').modal("show");
        var dbq_id = $(this).siblings(".dbq_id").attr("value");
        var dqb_id = $(this).siblings(".dqb_id").attr("value");
        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->request->baseUrl; ?>/dailybusqueue/replace",
            data: {'dbq':dbq_id, 'dqb':dqb_id},
            success: function (response) {
//            alert(response);
                $('#replaceModal').modal("show").find('.load-data').html(response);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
</script>
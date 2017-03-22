<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/print/print.js"></script>
<form action="<?php echo Yii::app()->request->baseUrl; ?>/DailyBusQueue/DailyRoute" method="POST">
    <input type="text" name="date" value="<?php echo @$_POST['date']?>" placeholder="yyyy-mm-dd" id="date" required="true" readonly>

    <input type="submit" value="Submit" name="submit">
</form>

<?php
if(!empty($checkedCostConf)){?>
    <div class="widget first">
        <div class="head"><h5 class="iFrames">Collected From Route</h5></div>
        <table cellpadding="0" cellspacing="0" width="100%" class="tableStatic">
            <thead>
            <tr>
                <th>Bus No</th><th>Route</th><th>Queue Date</th><th>Queue Time</th><th>Price</th><th>Receipt No.</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $grandTotal = 0;
            foreach($checkedCostConf as $cCC){
                $bus = Bus::model()->findByPk($cCC['bus_id']);
                if($cCC['checked_others']==null){
                    $routeName = Route::model()->findByPk($cCC['route_id']);
                    $queueTime = RouteTime::model()->findByPk($cCC['queue_time_id']);
                    $routeCost=$cCC['crc_samiti_sulka']+$cCC['crc_bhalai_kosh']+$cCC['crc_samrakshan']+$cCC['crc_ticket']+$cCC['crc_sahayog']+$cCC['crc_bima']+$cCC['crc_bibidh']+$cCC['crc_mandir']+$cCC['crc_jokhim']+$cCC['crc_anugaman']+$cCC['crc_bi_bya_sulka']+$cCC['crc_ma_kosh'];
                    ?>
                    <tr>
                        <td><?php echo $bus->bus_no;?></td>
                        <td><?php echo $routeName->route_name;?></td>
                        <td><?php echo $cCC['queue_date'];?></td>
                        <td><?php echo $queueTime->route_time;?></td>
                        <td><?php echo $routeCost; ?></td>
                        <td><a target="_blank" href="<?php echo Yii::app()->request->baseUrl.'/checkedcostconfiguration/'.$cCC['id']; ?>"><?php echo $cCC['receipt_no']; ?></a></td>
                    </tr>
                <?php }else{
                    $routeCost=$cCC['res_samiti_sulka']+$cCC['res_bhalai_kosh']+$cCC['res_samrakshan']+$cCC['res_ticket']+$cCC['res_sahayog']+$cCC['res_bima']+$cCC['res_bibidh']+$cCC['res_mandir']+$cCC['res_jokhim']+$cCC['res_anugaman']+$cCC['res_bi_bya_sulka']+$cCC['res_ma_kosh'];
                    ?>
                    <tr>
                        <td><?php echo $bus->bus_no;?></td>
                        <td>Reserve</td>
                        <td><?php echo $cCC['reserve_date'];?></td>
                        <td><?php echo $cCC['reserve_time'];?></td>
                        <td><?php echo $routeCost; ?></td>
                        <td><a target="_blank" href="<?php echo Yii::app()->request->baseUrl.'/reserve/'.$cCC['id']; ?>"><?php echo $cCC['receipt_no']; ?></a></td>
                    </tr>
                <?php }
                $grandTotal = $grandTotal + $routeCost;
            }
            ?>
            </tbody>
            <tfoot>
            <tr><th colspan="4" style="text-align: center">Grand Total = </th><th><?php echo $grandTotal;?></th><th></th></tr>
            </tfoot>

        </table>
    </div>
<?php }else{
    $user = Yii::app()->getComponent('user');
    $user->setFlash(
        'error',
        "<strong>No Results.</strong>"
    );
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
}?>

<script>
    $('#date').calendarsPicker({calendar: $.calendars.instance('nepali'), dateFormat: 'yyyy-mm-dd'});
</script>
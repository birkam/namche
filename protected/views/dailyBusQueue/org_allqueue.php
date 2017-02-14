<form action="<?php echo Yii::app()->request->baseUrl; ?>/DailyBusQueue/AllQueue" method="POST">
    <input type="text" name="date" value="<?php echo @$_POST['date']?>" placeholder="yyyy-mm-dd" id="date" required="true" readonly>
    <input type="submit" value="Submit" name="submit">
</form>
<?php
if(!empty($dailyBusQueue)){?>
<div class="printable">
    <h3>Date: <?php echo $_POST['date'];?></h3>
    <?php
    $route_sn = 1;
    foreach($dailyBusQueue as $dBQ){
        $routeName = Route::model()->findByPk($dBQ->route_id);
        echo "<strong>".$route_sn.') '.ucwords(strtolower($routeName->route_name))."</strong>";
        $time_id_arr = explode(',', $dBQ->time_id);
        $bus_id_arr = explode(',',$dBQ->bus_id);
        $payment_stat = explode(',',$dBQ->payment_status);
        ?>
        <table>
            <tr>
                <th>SNo.</th><th>Queue No.</th><th>Bus No.</th><th>Depart</th><th>Remarks</th>
            </tr>
            <?php
            $sn = 1;
        foreach (array_keys($time_id_arr + $bus_id_arr) as $tb) {
            $time = RouteTime::model()->findByPk($time_id_arr[$tb]);
            $bus = Bus::model()->findByPk($bus_id_arr[$tb]);

    ?>
            <tr>
                <td><?php echo $sn;?></td><td></td><td><?php echo $bus->bus_no;?></td><td><?php echo $time->route_time;?></td><td><?php if(in_array($bus->id, $payment_stat)){echo 'Paid';}?></td>
            </tr>
            <?php $sn = $sn +1 ; } ?>
        </table></br>
    <?php    $route_sn = $route_sn+1;    }?>
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


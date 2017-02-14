<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/print/print.js"></script>
<form action="<?php echo Yii::app()->request->baseUrl; ?>/DailyBusQueue/DailyRoute" method="POST">
    <input type="text" name="date" value="<?php echo @$_POST['date']?>" placeholder="yyyy-mm-dd" id="date" required="true" readonly>

    <input type="submit" value="Submit" name="submit">
</form>

<?php
if(!empty($route)){?>
    <table>
        <tr>
            <th>Bus No</th><th>Route</th><th>Queue Date</th><th>Queue Time</th><th>Price</th>
        </tr>
        <?php
        $grandTotal = 0;
        foreach($route as $r){
            $bus = Bus::model()->findByPk($r->bus_id);
            $routeName = Route::model()->findByPk($r->route_id);
            $queueTime = RouteTime::model()->findByPk($r->queue_time_id);
//            $cost_arr = explode(',', $r->route_cost);
//            $sum = array_sum($cost_arr);
            $sum=$r->samiti_sulka+$r->bhalai_kosh+$r->samrakshan+$r->ticket+$r->sahayog+$r->bima+$r->bibidh+$r->mandir+$r->jokhim+$r->anugaman+$r->bi_bya_sulka+$r->ma_kosh;
            ?>
            <tr>
                <td><?php echo $bus->bus_no;?></td>
                <td><?php echo $routeName->route_name;?></td>
                <td><?php echo $r->queue_date;?></td>
                <td><?php echo $queueTime->route_time;?></td>
                <td><?php echo $r->samiti_sulka.'+'.$r->bhalai_kosh.'+'.$r->samrakshan.'+'.$r->ticket.'+'.$r->sahayog.'+'.$r->bima.'+'.$r->bibidh.'+'.$r->mandir.'+'.$r->jokhim.'+'.$r->anugaman.'+'.$r->bi_bya_sulka.'+'.$r->ma_kosh.'=<strong>'.$sum.'</strong>';?></td>
            </tr>
        <?php
            $grandTotal = $grandTotal + $sum;
        }
        ?>
        <tr><th colspan="4" style="text-align: center">Grand Total = </th><th><?php echo $grandTotal;?></th></tr>

    </table>
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
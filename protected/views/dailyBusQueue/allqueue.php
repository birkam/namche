<form action="<?php echo Yii::app()->request->baseUrl; ?>/DailyBusQueue/AllQueue" method="POST">
    <input type="text" name="date" value="<?php echo @$_POST['date']?>" placeholder="yyyy-mm-dd" id="date" required="true" readonly>
    <input type="submit" value="Submit" name="submit">
</form>
<style type="text/css" media="print">
    .qframe{
        width: 1060px;
        font-size: 15px;
    }
    .item.large {
        width:  350px;
        background: #D092E3;
        margin: 0 2px 10px 0;
        font-size: 15px;
    }
    * {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    .item.large {
        width:  350px;
        background: #D092E3;
        margin: 0 2px 10px 0;
        font-size: 15px;
    }
</style>
<?php
if(!empty($dailyBusQueue)){?>
    <!--    <a href="javascript:;" onclick="window.print()" class="hideme btn btn-sm btn-success m-b-10"> Print</a>-->
    <a href="<?php echo Yii::app()->request->baseUrl; ?>/DailyBusQueue/AllQueuePrint/?date=<?php echo $_POST['date'];?>" target="_blank" class="hideme btn btn-sm btn-success m-b-10">Print Queue
        Sheet</a>
    <div id='masonry' class="qframe" >
        <h5>Date: <?php echo $_POST['date'];?></h5>
        <?php
        $route_sn = 1;
        foreach($dailyBusQueue as $dBQ){
            $routeName = Route::model()->findByPk($dBQ->route_id);
            $queuedBus = DailyQueuedBus::model()->findAllByAttributes(array('daily_bus_queue_id'=>$dBQ->id));
            ?>
            <table  class="item large" border="1" cellspacing="0" cellpadding="0">
                <tr>
                    <td><?php echo "<strong>".$route_sn."</strong>"; ?></td>
                    <td colspan="4" style="text-align: center;color: #000; background-color: #fff;"><?php echo "<strong>".ucwords(strtolower($routeName->route_name))."</strong>"; ?></td>
                </tr>
                <tr>
                    <th>SNo.</th>
                    <th>Receipt No.</th>
                    <th>Bus No.</th>
                    <th>Depart</th>
                    <th>Remarks</th>
                </tr>
                <?php
                $sn = 1;
                foreach ($queuedBus as $qb) {
                    $time = RouteTime::model()->findByPk($qb->time_id);
                    $bus = Bus::model()->findByPk($qb->bus_id);
                    ?>
                    <tr>
                        <td><?php echo $sn;?></td>
                        <td></td>
                        <td><?php echo $bus->bus_no;?></td>
                        <td><?php echo $time->route_time;?></td>
                        <td><?php if($qb->payment_status==1){echo 'Paid';}?></td>
                    </tr>
                    <?php $sn = $sn +1 ; } ?>
            </table>
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

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/masonry.pkgd.min.js"></script>
<script>
    var container = document.querySelector('#masonry');
    var masonry = new Masonry(container, {
        columnWidth: 60,
        itemSelector: '.item'
    });
</script>
<script>
    $('#date').calendarsPicker({calendar: $.calendars.instance('nepali'), dateFormat: 'yyyy-mm-dd'});
</script>

<script>
    $(document).ready(function()
    {
        $(".newWindow").click(function(e)
        {
            e.preventDefault();
            var url=$(this).attr('href');
            window.open(url, "_blank", "toolbar=no, scrollbars=no, resizable=no, top=100, left=100, width=770, height=500");
        });
    });
</script>

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
    .man_header{height: 20px; font-size: 15px; text-align: center;margin: 0 0 5px 0;padding: 0;font-weight: bolder; text-transform: uppercase;}
    .man-header-date{float: right;
    clear: both;}
</style>
<style>
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
    <script type="text/javascript">
        window.onload=function(){self.print();}
    </script>
    <div class="man_header">PRBSS-Daily Queue Sheet <b class="man-header-date">[DATE : <?php echo $_GET['date'];?>]</b></div>

    <div id='masonry' class="qframe" >
        <?php
        $route_sn = 1;
        foreach($dailyBusQueue as $dBQ){
            $routeName = Route::model()->findByPk($dBQ->route_id);
            $time_id_arr = explode(',', $dBQ->time_id);
            $bus_id_arr = explode(',',$dBQ->bus_id);
            $payment_stat = explode(',',$dBQ->payment_status);
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
                foreach (array_keys($time_id_arr + $bus_id_arr) as $tb) {
                    $time = RouteTime::model()->findByPk($time_id_arr[$tb]);
                    $bus = Bus::model()->findByPk($bus_id_arr[$tb]);
                    ?>
                    <tr>
                        <td><?php echo $sn;?></td>
                        <td></td>
                        <td><?php echo $bus->bus_no;?></td>
                        <td><?php echo $time->route_time;?></td>
                        <td><?php if(in_array($bus->id, $payment_stat)){echo 'Paid';}?></td>
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


<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/print/print.js"></script>
<form action="<?php echo Yii::app()->request->baseUrl; ?>/DailyBusQueue/Transaction" method="POST">
    <input type="text" name="date" value="<?php echo @$_POST['date']?>" placeholder="yyyy-mm-dd" id="date">

    <input type="submit" value="Submit" name="submit">
</form>
<?php if(!empty($checkedOthers) or !empty($checkedCostConf) or !empty($checkedRouteCost)){?>
    <table>
        <tr>
            <th>Particulars</th><th>Price</th><th>Bus</th>
        </tr>
        <?php
        $checked_id_total = '';
        $checked_rate_total = '';
        $bus_id_arr = array();
        if(!empty($checkedCostConf)){
            $cost_id = array();
            $rate = array();
            foreach($checkedCostConf as $cCC){
                $cost_id[]=$cCC->checked_id;
                $rate[]=$cCC->checked_rate;
                $bus_id_arr[]=$cCC->bus_id;
            }
            $cost_id_arr_tot =  explode(',',implode(',', $cost_id));
            $rate_arr_tot =  explode(',',implode(',', $rate));

            $joined = array();
            foreach(array_keys($cost_id_arr_tot + $rate_arr_tot) as $keys){
                $joined[$keys] = $cost_id_arr_tot[$keys].'+'.$rate_arr_tot[$keys].',';
                $costConfiguration = CostConfiguration::model()->findByPk($cost_id_arr_tot[$keys]);
                ?>
                <tr>
                    <td><?php echo $costConfiguration->particular;?></td><td><?php echo $rate_arr_tot[$keys]?></td><td><?php echo '';?></td>
                </tr>
            <?php
            }
            exit;
            ?>
            <?php
            exit;
            foreach($checkedCostConf as $cCC){
                $checked_id_arr = explode(', ', $cCC->checked_id);
                $checked_id_arr_total[] = $checked_id_arr;
            }
        }
        foreach($checked_id_arr as $cia){
            ?>
            <tr>
                <td><?php echo $cia;?></td>
                <td><?php// echo $cCC->checked_rate;?></td>
            </tr>
        <?php }?>

    </table>
<?php }?>
<script>
    $('#date').calendarsPicker({calendar: $.calendars.instance('nepali'), dateFormat: 'yyyy-mm-dd'});
</script>
<?php
/**
 * Created by PhpStorm.
 * User: Hero
 * Date: 3/21/2017
 * Time: 9:08 AM
 */
?>
<a href="<?php echo Yii::app()->request->baseUrl; ?>/csv/view?type=csv">To CSV</a>
<table>
    <tr>
        <td>sno</td>
        <td>id</td>
        <td>time_id</td>
        <td>bus_id</td>
        <td>queue_serial</td>
        <td>payment_status</td>
    </tr>
    <?php
    $sno=0;
    foreach ($model as $m){
        $t_arr = explode(',', $m->time_id);
        $b_arr = explode(',', $m->bus_id);
        $q_arr = explode(',', $m->queue_serial);
        $p_sts_arr = explode(',', $m->payment_status);
        if(count($t_arr)==count($b_arr) && count($t_arr)==count($q_arr)) {
            foreach (array_keys($t_arr + $b_arr + $q_arr) as $tb) {
                $bid=$b_arr[$tb];
                $psts=0;
                if(in_array($bid, $p_sts_arr))
                    $psts=1;
                ?>
                <tr>
                    <td><?= ++$sno; ?></td>
                    <td><?= $m->id; ?></td>
                    <td><?= $t_arr[$tb]; ?></td>
                    <td><?= $bid; ?></td>
                    <td><?= $q_arr[$tb]; ?></td>
                    <td><?= $psts; ?></td>
                </tr>
            <?php }
        }else{
            var_dump($m->id);exit;
        }
    } ?>
</table>
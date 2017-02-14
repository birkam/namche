<form action="<?php echo Yii::app()->request->baseUrl; ?>/DailyBusQueue/DailyAll" method="POST">
    <input type="text" name="date" value="<?php echo @$_POST['date']?>" placeholder="yyyy-mm-dd" id="date" required="true" readonly>

    <input type="submit" value="Submit" name="submit">
</form>
<?php
if(!empty($checkedCostConf)){?>
    <table>
        <tr>
            <th>Particulars</th><th>Price</th><th>Bus No</th>
        </tr>
        <?php
        $grandTotal = 0;
        foreach($checkedCostConf as $cCC){
            $checked_id = $cCC->checked_id;
            $checked_id_arr = explode(',',$checked_id);
            $criteria = new CDbCriteria();
            $criteria->addInCondition("id", $checked_id_arr);
            $checked_particulars = CostConfiguration::model()->findAll($criteria);
            $checked_rate_arr = explode(', ',$cCC->checked_rate);
            $checked_rate_str = implode('+',$checked_rate_arr);
            $bus = Bus::model()->findByPk($cCC->bus_id);

            $routeCost = CheckedRouteCost::model()->findAllByAttributes(array('checked_cost_conf_id'=>$cCC->id));
            if($cCC->checked_others==1) {
                $others = CheckedOthers::model()->findAllByAttributes(array('checked_cost_conf_id' => $cCC->id));
            }else{
                $others=array();
            }
            if($cCC->checked_others==2) {
                $reserve = Reserve::model()->findAllByAttributes(array('checked_cost_conf_id' => $cCC->id));
            }else{
                $reserve=array();            }
//foreach($routeCost as $rC){echo $rC->id;}
            ?>

            <tr>
                <td>
                    <?php

                    foreach($checked_particulars as $cp){
                        echo $cp->particular.', ';
                    }
                    foreach($routeCost as $rC){
                        if($rC->checked_cost_conf_id == $cCC->id){
                            echo 'route cost, ';
                        }
                    }
                    foreach($others as $ot){
                        if($ot->checked_cost_conf_id == $cCC->id){
                            echo 'others,';
                        }
                    }
                    foreach($reserve as $res){
                        if($res->checked_cost_conf_id == $cCC->id){
                            echo 'Reserve,';
                        }
                    }
                    ?>
                </td><td><?php
                    echo $checked_rate_str;
                    $costConfTotal = array_sum($checked_rate_arr);
                    $gt1 = 0;
                    if(!empty($routeCost)){
                        foreach($routeCost as $rC){
                            if($rC->checked_cost_conf_id == $cCC->id){
                                $o = null;
//                                $rr = explode(',', $rC->route_cost);
//                                $r = array_sum($rr);
                                $r=$rC->samiti_sulka+$rC->bhalai_kosh+$rC->samrakshan+$rC->ticket+$rC->sahayog+$rC->bima+$rC->bibidh+$rC->mandir+$rC->jokhim+$rC->anugaman+$rC->bi_bya_sulka+$rC->ma_kosh;
                                echo '+'.$r;
                                $gt1 = $costConfTotal + $gt1 + $r;
                            }
                        }
                    }else{
                        $r = null;
                        $gt1 = $costConfTotal + $gt1 + $r;
                    }
                    $gt2 = 0;
                    if(!empty($others)){
                        foreach($others as $ot){
                            if($ot->checked_cost_conf_id == $cCC->id){
                                if(!empty($routeCost)){
//                                    $rr = explode(',', $rC->route_cost);
//                                    $r = array_sum($rr);
                                    $r=$rC->samiti_sulka+$rC->bhalai_kosh+$rC->samrakshan+$rC->ticket+$rC->sahayog+$rC->bima+$rC->bibidh+$rC->mandir+$rC->jokhim+$rC->anugaman+$rC->bi_bya_sulka+$rC->ma_kosh;
                                }else{
                                    $r = null;
                                }
                                $o = $ot->amount;
                                echo '+'.$o;
                                $gt2 = $costConfTotal +$r + $gt1 + $gt2;
                            }
                        }
                    }else{
                        $o = null;
                        $gt2 = $costConfTotal +$r + $gt1 + $gt2;
                    }if(!empty($reserve)){
                        foreach($reserve as $res){
                            if($res->checked_cost_conf_id == $cCC->id){
                                $resamt= $res->samiti_sulka+$res->bhalai_kosh+$res->samrakshan+$res->ticket+$res->sahayog+$res->bima+$res->bibidh+$res->mandir+$res->jokhim+$res->anugaman+$res->bi_bya_sulka+$res->ma_kosh;
                            }else{
                                $resamt=null;
                            }
                            echo '+';
                        }
                    }
                    $subTotal = $costConfTotal + $r + $o;
                    echo '=';
                    echo $subTotal;
                    $grandTotal = $grandTotal + $subTotal;
                    ?>
                </td><td><?php echo $bus->bus_no;?></td></tr>
            <?php
        }
        ?>
        <tr><th>Grand Total = </th><th><?php echo $grandTotal;?></th></tr>

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
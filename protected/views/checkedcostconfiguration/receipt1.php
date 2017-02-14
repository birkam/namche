
<!--<span class="pull-right hidden-print">-->
<!--    <a href="javascript:;" onclick="window.print()" class="hideme btn btn-sm btn-success m-b-10"> Print</a>-->
<!--</span>-->
<script type="text/javascript">
    window.onload=function(){self.print();}
</script>
<style media="print">
    .print-receipt{
        font-size: 13px;
        font-family: monospace ;
        width:770px;
        font-weight: lighter !important;
        border:none;
        margin-left: -90px;
        padding: 0;
    }
    .receipt-items{
        margin-top:15px;
    }
</style>
<?php
function convert_number_to_words($number) {

    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'Zero',
        1                   => 'One',
        2                   => 'Two',
        3                   => 'Three',
        4                   => 'Four',
        5                   => 'Five',
        6                   => 'Six',
        7                   => 'Seven',
        8                   => 'Eight',
        9                   => 'Nine',
        10                  => 'Ten',
        11                  => 'Eleven',
        12                  => 'Twelve',
        13                  => 'Thirteen',
        14                  => 'Fourteen',
        15                  => 'Fifteen',
        16                  => 'Sixteen',
        17                  => 'Seventeen',
        18                  => 'Eighteen',
        19                  => 'Nineteen',
        20                  => 'Twenty',
        30                  => 'Thirty',
        40                  => 'Fourty',
        50                  => 'Fifty',
        60                  => 'Sixty',
        70                  => 'Seventy',
        80                  => 'Eighty',
        90                  => 'Ninety',
        100                 => 'Hundred',
        1000                => 'Thousand',
        1000000             => 'Million',
        1000000000          => 'Billion',
        1000000000000       => 'Trillion',
        1000000000000000    => 'Quadrillion',
        1000000000000000000 => 'Quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}
?>
<?php
$id = $model->id;
$check_id = $model->checked_id;
$check_rate = $model->checked_rate;
$check_id_arr = explode(',',$check_id);
$check_rate_arr = explode(',',$check_rate);
$bus_id = $model->bus_id;
$bus = Bus::model()->findByPk($bus_id);
$bus_no = $bus->bus_no;
$bus_own_id = $model->owners_id;

$bus_driver_id = $model->driver_id;
$driverInfo = DriverInfo::model()->findByPk($bus_driver_id);
if(!empty($driverInfo)){
    $driver_name = strtoupper($driverInfo->fname.' '.$driverInfo->mname.' '.$driverInfo->lname);
    $driver_licence_no = strtoupper($driverInfo->licence_no);
}else{
    $driver_name = 'Drive Not Assigned';
    $driver_licence_no = '----';
}
$bus_own_id_arr = explode(', ', $bus_own_id);
$bus_own_name_arr = array();
foreach($bus_own_id_arr as $key=>$val){
    $bus_owners = BusOwner::model()->findByPk($val);
    $bus_own_name = $bus_owners->fname.' '.$bus_owners->mname.' '.$bus_owners->lname;
    $bus_own_name_arr[$bus_own_name] = $bus_own_name;
}
$bus_own_name_str = implode(',  ',$bus_own_name_arr);
//var_dump($check_id_arr);
//echo '<br>';
//var_dump($check_rate_arr);
$created_by = $model->created_by;
$user_account = UserAccount::model()->findByPk($created_by);
$user_detail_id = $user_account->user_id;
$user_detail = UserDetails::model()->findByPk($user_detail_id);
$cashier = $user_detail->name;

$others = CheckedOthers::model()->findByAttributes(array('bus_id'=>$bus_id, 'checked_cost_conf_id'=>$id));
if(!empty($others)){
    $others_particular = $others->particular;
    $others_amount = $others->amount;
}else{
    $others_amount = 0;
}
$CheckedRouteCost = CheckedRouteCost::model()->findByAttributes(array('bus_id'=>$bus_id, 'checked_cost_conf_id'=>$id));
if(!empty($CheckedRouteCost)){
    $samiti_sulka_p = 'Route Cost';
    $queueDate = $CheckedRouteCost->queue_date;
    $routeTime = RouteTime::model()->model()->findByPk($CheckedRouteCost->queue_time_id);
    $routeCost=$CheckedRouteCost->samiti_sulka+$CheckedRouteCost->bhalai_kosh+$CheckedRouteCost->samrakshan+$CheckedRouteCost->ticket+$CheckedRouteCost->sahayog+$CheckedRouteCost->bima+$CheckedRouteCost->bibidh+$CheckedRouteCost->mandir+$CheckedRouteCost->jokhim+$CheckedRouteCost->anugaman+$CheckedRouteCost->bi_bya_sulka+$CheckedRouteCost->ma_kosh;
}else{
    $routeCost = '';
}
?>
<div class="print-receipt">

<table  border="0" align="center" cellpadding="0" cellspacing="0" >
    <tr>
        <td width="180" align="left" scope="col">Receipt no:<?php echo $model->receipt_no; ?></td>
        <td width="200" align="left" colspan="2"scope="col">Name: <?php echo strtoupper($bus_own_name_str); ?></td>
        <td width="190" align="left" scope="col">
            Date: <?php
            echo $model->created_nep_date. ' | ' ;
            $date = strtotime($model->created_date);
            $time = date('G:i', $date);
            echo $time;
            ?>
        </td>
    </tr>
    <tr>
        <td align="left" scope="col">Bus No : &nbsp;<?php echo $bus_no;?></td>
        <td align="right" scope="col">Queue/Reserve Date: </td>
        <td align="left" scope="col"> &nbsp;&nbsp;</td>
        <td align="left" scope="col">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if(!empty($CheckedRouteCost)){ echo $queueDate.' '.$routeTime->route_time; } ?> </td>
    </tr>
    <tr>
        <td height="280" colspan="4" align="center" valign="top">
            <table width="98%" border="0" cellpadding="0" cellspacing="0" class="receipt-items">
                <tr>
                    <td width="5%" valign="top" align="left">
                        SN                        </td>

                    <td width="30%" valign="top" align="left">
                        Particulars
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <?php if(!empty($CheckedRouteCost)){?>
                                <tr><td><?php echo 'samiti sulka';?></td></tr>
                                <tr><td><?php echo 'bhalai kosh';?></td></tr>
                                <tr><td><?php echo 'samrakshan';?></td></tr>
                                <tr><td><?php echo 'ticket';?></td></tr>
                                <tr><td><?php echo 'sahayog';?></td></tr>
                                <tr><td><?php echo 'bima';?></td></tr>
                                <tr><td><?php echo 'bibidh';?></td></tr>
                                <tr><td><?php echo 'mandir';?></td></tr>
                                <tr><td><?php echo 'jokhim';?></td></tr>
                                <tr><td><?php echo 'anugaman';?></td></tr>
                                <tr><td><?php echo 'bi. bya. sulka';?></td></tr>
                                <tr><td><?php echo 'ma kosh';?></td></tr>
                            <?php } ?>
                            <?php
                            foreach($check_id_arr as $key=>$val){
                                $costConf = CostConfiguration::model()->findByPk($val);
                                if(!empty($costConf)){
                                    ?>
                                    <tr>
                                        <td><?php echo $costConf->particular;?></td>
                                    </tr>
                                <?php }
                            }
                            if(!empty($others)){?>
                                <tr>
                                    <td><?php echo $others_particular;?></td>
                                </tr>
                            <?php }?>

                        </table>
                    </td>
                    <td width="20%" align="right" valign="top" scope="col">
                        Rate [Rs]
                        <table width="100%" border="0"    cellspacing="0" cellpadding="0">

                            <?php
                            $total = 0;
                            if(!empty($CheckedRouteCost)){?>
                                <tr><td align="right"><?php echo $CheckedRouteCost->samiti_sulka;?></td></tr>
                                <tr><td align="right"><?php echo $CheckedRouteCost->bhalai_kosh;?></td></tr>
                                <tr><td align="right"><?php echo $CheckedRouteCost->samrakshan;?></td></tr>
                                <tr><td align="right"><?php echo $CheckedRouteCost->ticket;?></td></tr>
                                <tr><td align="right"><?php echo $CheckedRouteCost->sahayog;?></td></tr>
                                <tr><td align="right"><?php echo $CheckedRouteCost->bima;?></td></tr>
                                <tr><td align="right"><?php echo $CheckedRouteCost->bibidh;?></td></tr>
                                <tr><td align="right"><?php echo $CheckedRouteCost->mandir;?></td></tr>
                                <tr><td align="right"><?php echo $CheckedRouteCost->jokhim;?></td></tr>
                                <tr><td align="right"><?php echo $CheckedRouteCost->anugaman;?></td></tr>
                                <tr><td align="right"><?php echo $CheckedRouteCost->bi_bya_sulka;?></td></tr>
                                <tr><td align="right"><?php echo $CheckedRouteCost->ma_kosh;?></td></tr>
                            <?php
                            }
                            if(!empty($check_rate)){
                                foreach($check_rate_arr as $keyr=>$valr){
                                    ?>
                                    <tr>
                                        <td align="right"><?php echo  $valr;?></td>
                                    </tr>
                                    <?php
                                    $total = $total + $valr;
                                }
                            }
                            if(!empty($others)){?>
                                <tr>
                                    <td align="right"><?php echo $others_amount;?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </td>
                    <td width="45%" align="center" valign="top"   scope="col">Remarks </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="4">
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="20%" align="left" scope="col">Grand Total :</td>
                    <td colspan="2" width="35%" align="right" scope="col"><?php
                        $grandTotal = $total + $others_amount + $routeCost;
                        echo 'Rs. '.$grandTotal;?></td>
                    <td width="45%" scope="col">&nbsp;</td>
                </tr>
                <tr>
                    <td width="20%" align="left">In Words :</td>
                    <td colspan="3" align="left"><?php echo strtoupper(convert_number_to_words($grandTotal)).' ONLY';?></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr class="receipt-footer">
        <td colspan="4" valign="baseline">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="12%" height="25" align="left" scope="col">Drivers Name :</td>
                    <td width="25%" height="25" align="left" scope="col">&nbsp;&nbsp;<?php echo $driver_name;?></td>
                    <td width="18%" height="25" scope="col"<?php echo strtoupper($cashier);?></td>
                    <td width="15%" height="25" scope="col">&nbsp;</td>
                </tr>
                <tr>
                    <td height="25">Lisence/Card No. :</td>
                    <td height="25" align="left">&nbsp;&nbsp;<?php echo $driver_licence_no;?></td>
                    <td height="25">Cashier</td>
                    <td height="25">Signature</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<table  border="0" align="center" cellpadding="0" cellspacing="0"  style="margin-top: 6cm">
    <tr>
        <td width="180" align="left" scope="col">Receipt no:<?php echo $model->receipt_no; ?></td>
        <td width="200" align="left" colspan="2"scope="col">Name: <?php echo strtoupper($bus_own_name_str); ?></td>
        <td width="190" align="left" scope="col">
            Date: <?php
            echo $model->created_nep_date. ' | ' ;
            $date = strtotime($model->created_date);
            $time = date('G:i', $date);
            echo $time;
            ?>
        </td>
    </tr>
    <tr>
        <td align="left" scope="col">Bus No : &nbsp;<?php echo $bus_no;?></td>
        <td align="right" scope="col">Queue/Reserve Date: </td>
        <td align="left" scope="col"> &nbsp;&nbsp;</td>
        <td align="left" scope="col">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if(!empty($CheckedRouteCost)){ echo $queueDate.' '.$routeTime->route_time; } ?> </td>
    </tr>
    <tr>
        <td height="280" colspan="4" align="center" valign="top">
            <table width="98%" border="0" cellpadding="0" cellspacing="0" class="receipt-items">
                <tr>
                    <td width="5%" valign="top" align="left">
                        SN                        </td>

                    <td width="30%" valign="top" align="left">
                        Particulars
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <?php if(!empty($CheckedRouteCost)){?>
                                <tr><td><?php echo 'samiti sulka';?></td></tr>
                                <tr><td><?php echo 'bhalai kosh';?></td></tr>
                                <tr><td><?php echo 'samrakshan';?></td></tr>
                                <tr><td><?php echo 'ticket';?></td></tr>
                                <tr><td><?php echo 'sahayog';?></td></tr>
                                <tr><td><?php echo 'bima';?></td></tr>
                                <tr><td><?php echo 'bibidh';?></td></tr>
                                <tr><td><?php echo 'mandir';?></td></tr>
                                <tr><td><?php echo 'jokhim';?></td></tr>
                                <tr><td><?php echo 'anugaman';?></td></tr>
                                <tr><td><?php echo 'bi. bya. sulka';?></td></tr>
                                <tr><td><?php echo 'ma kosh';?></td></tr>
                            <?php } ?>
                            <?php
                            foreach($check_id_arr as $key=>$val){
                                $costConf = CostConfiguration::model()->findByPk($val);
                                if(!empty($costConf)){
                                    ?>
                                    <tr>
                                        <td><?php echo $costConf->particular;?></td>
                                    </tr>
                                <?php }
                            }
                            if(!empty($others)){?>
                                <tr>
                                    <td><?php echo $others_particular;?></td>
                                </tr>
                            <?php }?>

                        </table>
                    </td>
                    <td width="20%" align="right" valign="top" scope="col">
                        Rate [Rs]
                        <table width="100%" border="0"    cellspacing="0" cellpadding="0">

                            <?php
                            $total = 0;
                            if(!empty($CheckedRouteCost)){?>
                                <tr><td align="right"><?php echo $CheckedRouteCost->samiti_sulka;?></td></tr>
                                <tr><td align="right"><?php echo $CheckedRouteCost->bhalai_kosh;?></td></tr>
                                <tr><td align="right"><?php echo $CheckedRouteCost->samrakshan;?></td></tr>
                                <tr><td align="right"><?php echo $CheckedRouteCost->ticket;?></td></tr>
                                <tr><td align="right"><?php echo $CheckedRouteCost->sahayog;?></td></tr>
                                <tr><td align="right"><?php echo $CheckedRouteCost->bima;?></td></tr>
                                <tr><td align="right"><?php echo $CheckedRouteCost->bibidh;?></td></tr>
                                <tr><td align="right"><?php echo $CheckedRouteCost->mandir;?></td></tr>
                                <tr><td align="right"><?php echo $CheckedRouteCost->jokhim;?></td></tr>
                                <tr><td align="right"><?php echo $CheckedRouteCost->anugaman;?></td></tr>
                                <tr><td align="right"><?php echo $CheckedRouteCost->bi_bya_sulka;?></td></tr>
                                <tr><td align="right"><?php echo $CheckedRouteCost->ma_kosh;?></td></tr>
                            <?php
                            }
                            if(!empty($check_rate)){
                                foreach($check_rate_arr as $keyr=>$valr){
                                    ?>
                                    <tr>
                                        <td align="right"><?php echo  $valr;?></td>
                                    </tr>
                                    <?php
                                    $total = $total + $valr;
                                }
                            }
                            if(!empty($others)){?>
                                <tr>
                                    <td align="right"><?php echo $others_amount;?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </td>
                    <td width="45%" align="center" valign="top"   scope="col">Remarks </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="4">
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="20%" align="left" scope="col">Grand Total :</td>
                    <td colspan="2" width="35%" align="right" scope="col"><?php
                        $grandTotal = $total + $others_amount + $routeCost;
                        echo 'Rs. '.$grandTotal;?></td>
                    <td width="45%" scope="col">&nbsp;</td>
                </tr>
                <tr>
                    <td width="20%" align="left">In Words :</td>
                    <td colspan="3" align="left"><?php echo strtoupper(convert_number_to_words($grandTotal)).' ONLY';?></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr class="receipt-footer">
        <td colspan="4" valign="baseline">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="12%" height="25" align="left" scope="col">Drivers Name :</td>
                    <td width="25%" height="25" align="left" scope="col">&nbsp;&nbsp;<?php echo $driver_name;?></td>
                    <td width="18%" height="25" scope="col"<?php echo strtoupper($cashier);?></td>
                    <td width="15%" height="25" scope="col">&nbsp;</td>
                </tr>
                <tr>
                    <td height="25">Lisence/Card No. :</td>
                    <td height="25" align="left">&nbsp;&nbsp;<?php echo $driver_licence_no;?></td>
                    <td height="25">Cashier</td>
                    <td height="25">Signature</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</div>

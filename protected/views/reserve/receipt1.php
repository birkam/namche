<span class="pull-right hidden-print">
    <a href="javascript:;" onclick="window.print()" class="hideme btn btn-sm btn-success m-b-10"> Print</a>
</span>

<style media="print">
    .print-receipt{
        width=870px;
        height:550px;
        border:none;
    }
    .receipt-items{
        margin-top:20px;
    }
    .receipt-bg{
        background-color:#CCC;!important;
    }
    .hideme{
        display: none;
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
$check_rate = $model->checked_rate;
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
    $driver_name = 'Drive No Assigned';
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
//echo '<br>';
//var_dump($check_rate_arr);
$created_by = $model->created_by;
$user_account = UserAccount::model()->findByPk($created_by);
$user_detail_id = $user_account->user_id;
$user_detail = UserDetails::model()->findByPk($user_detail_id);
$cashier = $user_detail->name;
$reserve=Reserve::model()->findByAttributes(array('checked_cost_conf_id'=>$model->id));
?>
<table width="870" height="550" border="0" align="center" cellpadding="0" cellspacing="0" class="print-receipt">
    <tr>
        <th height="100" colspan="4" align="right" scope="col">
        </th>
    </tr>
    <tr>
        <th width="173" align="left" scope="col">Receipt no:<em><?php echo $model->receipt_no; ?></em></th>
        <th width="156" align="right" scope="col">Name</th>
        <th width="248" align="left" scope="col"><em>&nbsp;&nbsp;&nbsp;<?php echo strtoupper($bus_own_name_str); ?></em></th>
        <th width="293" align="left" scope="col">Date<em>&nbsp;&nbsp;&nbsp;<?php echo $model->created_date;?> </em></th>
    </tr>
    <tr>
        <th align="left" scope="col">Bus No : <em>&nbsp;<?php echo $bus_no;?></em></th>
        <th align="right" scope="col">
            <?php if(!empty($CheckedRouteCost)){?>
                <p>Queue Type : <?php if($CheckedRouteCost->payment_type == '1'){$tp='Single Queue';}elseif($CheckedRouteCost->payment_type == '2'){$tp='Double Queue';}elseif($CheckedRouteCost->payment_type == '3'){$tp='Triple Queue';}else{$tp = '-';}echo $tp;?></p>
            <?php } ?>
        </th>
        <th align="left" scope="col"><em> &nbsp;&nbsp;&nbsp; <?php echo $reserve->reserve_date;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $reserve->reserve_time;?></em></th>
        <th align="left" scope="col"><em>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</em></th>
    </tr>
    <tr>
        <td height="250" colspan="4" align="center" valign="top">
            <table width="98%" border="0" cellpadding="0" cellspacing="0" class="receipt-items">
                <tr>

                    <td width="40%" align="left"  scope="" col"">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <th  >Particulars</th>
                        </tr>
                        <?php if(!empty($reserve)){?>
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
                    </table>
                    </td>
                    <td width="10%" align="right" scope="col">
                        <table width="100%" border="0"  cellspacing="0" cellpadding="0">
                            <tr>
                                <th width="100%" align="right"  >Rate[Rs]</th>
                            </tr>
                            <?php
                            $total = 0;
                            if(!empty($reserve)){  ?>
                                <tr><td align="right"><?php echo $reserve->samiti_sulka;?></td></tr>
                                <tr><td align="right"><?php echo $reserve->bhalai_kosh;?></td></tr>
                                <tr><td align="right"><?php echo $reserve->samrakshan;?></td></tr>
                                <tr><td align="right"><?php echo $reserve->ticket;?></td></tr>
                                <tr><td align="right"><?php echo $reserve->sahayog;?></td></tr>
                                <tr><td align="right"><?php echo $reserve->bima;?></td></tr>
                                <tr><td align="right"><?php echo $reserve->bibidh;?></td></tr>
                                <tr><td align="right"><?php echo $reserve->mandir;?></td></tr>
                                <tr><td align="right"><?php echo $reserve->jokhim;?></td></tr>
                                <tr><td align="right"><?php echo $reserve->anugaman;?></td></tr>
                                <tr><td align="right"><?php echo $reserve->bi_bya_sulka;?></td></tr>
                                <tr><td align="right"><?php echo $reserve->ma_kosh;?></td></tr>
                            <?php } ?>
                        </table>
                    </td>
                    <th width="50%" align="center" valign="top"   scope="col">Remarks </th>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="4"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <th width="14%" align="right" scope="col">Grand Total :</th>
                    <th width="30%" align="right" scope="col">&nbsp;</th>
                    <th colspan="3" align="left" scope="col"><em><?php
                            $grandTotal = $reserve->samiti_sulka+$reserve->bhalai_kosh+$reserve->samrakshan+$reserve->ticket+
                                $reserve->sahayog+$reserve->bima+$reserve->bibidh+$reserve->mandir+$reserve->jokhim+$reserve->anugaman+
                                $reserve->bi_bya_sulka+$reserve->ma_kosh;
                            echo 'Rs. '.$grandTotal;?></em></th>
                    <th width="28%" scope="col">&nbsp;</th>
                </tr>
                <tr>
                    <th align="right">In Words :</th>
                    <th colspan="5" align="left"><em>&nbsp;&nbsp;&nbsp;</em><em>&nbsp;&nbsp;&nbsp;<?php echo strtoupper(convert_number_to_words($grandTotal)).' ONLY';?></em></th>
                </tr>
            </table></td>
    </tr>
    <tr>
        <th colspan="4" valign="baseline">
            <table width="100%" border="0" cellpadding="0" cellspacing="0" class="receipt-items">
                <tr>
                <th width="14%" height="35" align="left" scope="col">Drivers Name :</th>
                <th width="53%" height="35" align="left" scope="col"><em>&nbsp;</em><em>&nbsp;&nbsp;&nbsp;</em><em><?php echo $driver_name;?></em></th>
                <th width="18%" height="35" scope="col"<?php echo strtoupper($cashier);?></th>
        <th width="15%" height="35" scope="col">&nbsp;</th>
    </tr>
    <tr>
        <td height="35">Lisence Number :</td>
        <td height="35" align="left"><em>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $driver_licence_no;?></em></td>
        <td height="35">Cashier</td>
        <td height="35">Signature</td>
    </tr>
</table></th>
</tr>
</table>
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>USer Interface</title>
</head>

<body>
<div class="printable">
    <table width="300" height="450" border="1" align="center" cellpadding="1" cellspacing="0">
        <tr>
            <td><table width="600" border="0" align="center" cellpadding="1" cellspacing="0">
                    <tr>
                        <td colspan="2" align="center" valign="top"><h3>Prithvi Rajmarga Bus Sanchalak Samiti</h3>
                            <p>Estd : 2029</p>
                            <p>Office : <strong>Pokhara</strong></p></td>
                    </tr>
                    <tr>
                        <td width="391" height="27">Receipt no : <?php echo $model->receipt_no; ?></td>
                        <td width="401">Date : <?php echo $model->created_date;?></td>
                    </tr>
                    <tr>
                        <td colspan="2"><p>Name : <?php echo strtoupper($bus_own_name_str); ?></p>
                            <p>Bus Number : <?php echo $bus_no;?></p>
                            <p>Queue Type : Reserve</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><table width="600" border="0" align="left" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td><table width="300" border="2" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <th>Particulars</th>
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
                                            <tr>
                                                <td>
                                                    <strong>Grand Total : </strong>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>


                                    <td><table width="300" border="2" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <th>Rate</th>
                                            </tr>
                                            <?php
                                            if(!empty($reserve)){  ?>
                                                <tr><td>Rs. <?php echo $reserve->samiti_sulka;?></td></tr>
                                                <tr><td>Rs. <?php echo $reserve->bhalai_kosh;?></td></tr>
                                                <tr><td>Rs. <?php echo $reserve->samrakshan;?></td></tr>
                                                <tr><td>Rs. <?php echo $reserve->ticket;?></td></tr>
                                                <tr><td>Rs. <?php echo $reserve->sahayog;?></td></tr>
                                                <tr><td>Rs. <?php echo $reserve->bima;?></td></tr>
                                                <tr><td>Rs. <?php echo $reserve->bibidh;?></td></tr>
                                                <tr><td>Rs. <?php echo $reserve->mandir;?></td></tr>
                                                <tr><td>Rs. <?php echo $reserve->jokhim;?></td></tr>
                                                <tr><td>Rs. <?php echo $reserve->anugaman;?></td></tr>
                                                <tr><td>Rs. <?php echo $reserve->bi_bya_sulka;?></td></tr>
                                                <tr><td>Rs. <?php echo $reserve->ma_kosh;?></td></tr>
                                                <?php
                                            } ?>
                                            <tr>
                                                <td><?php
                                                    $grandTotal = $reserve->samiti_sulka+$reserve->bhalai_kosh+$reserve->samrakshan+$reserve->ticket+
                                                        $reserve->sahayog+$reserve->bima+$reserve->bibidh+$reserve->mandir+$reserve->jokhim+$reserve->anugaman+
                                                        $reserve->bi_bya_sulka+$reserve->ma_kosh;
                                                    echo 'Rs. '.$grandTotal;?></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table></td>
                    </tr>
                    <tr>
                        <td colspan="2"><?php echo strtoupper(convert_number_to_words($grandTotal)).' ONLY';?></td>
                    </tr>
                    <tr>

                        <td height="72" align="left" valign="top">
                            <?php if(!empty($reserve)){?>
                                <p>Reserve Time : <?php echo $reserve->reserve_date.' '.$reserve->reserve_time;?></p>
                                <p></p><?php } ?></td>
                        <td align="left" valign="top"><p>Drivers Name : <?php echo $driver_name;?></p>
                            <p>License number : <?php echo $driver_licence_no;?></p></td>
                    </tr>
                    <tr>
                        <td align="center"><p><?php echo strtoupper($cashier);?></p>
                            <p>Cashier</p></td>
                        <td align="center"><p>.....................................</p>
                            <p>Signature</p></td>
                    </tr>
                </table></td>
        </tr>
    </table>
    <hr style='page-break-after:always; color: white; background-color: white'>
</div>
</body>
</html>
<p>
    <z><button>Print</button></z>
</p>
<script type="text/javascript">

    // When the document is ready, initialize the link so
    // that when it is clicked, the printable area of the
    // page will print.
    $(
        function(){

// Hook up the print link.
            $( "z" )
                .attr( "href", "javascript:void( 0 )" )
                .click(
                function(){
// Print the DIV.
                    $( ".printable" ).print();

// Cancel click event.
                    return( false );
                }
            )
            ;

        }
    );

    // Create a jquery plugin that prints the given element.
    jQuery.fn.print = function(){
// NOTE: We are trimming the jQuery collection down to the
// first element in the collection.
        if (this.size() > 1){
            this.eq( 0 ).print();
            return;
        } else if (!this.size()){
            return;
        }

// ASSERT: At this point, we know that the current jQuery
// collection (as defined by THIS), contains only one
// printable element.

// Create a random name for the print frame.
        var strFrameName = ("printer-" + (new Date()).getTime());

// Create an iFrame with the new name.
        var jFrame = $( "<iframe name='" + strFrameName + "'>" );

// Hide the frame (sort of) and attach to the body.
        jFrame
            .css( "width", "1px" )
            .css( "height", "1px" )
            .css( "position", "absolute" )
            .css( "left", "-9999px" )
            .appendTo( $( "body:first" ) )
        ;

// Get a FRAMES reference to the new frame.
        var objFrame = window.frames[ strFrameName ];

// Get a reference to the DOM in the new frame.
        var objDoc = objFrame.document;

// Grab all the style tags and copy to the new
// document so that we capture look and feel of
// the current document.

// Create a temp document DIV to hold the style tags.
// This is the only way I could find to get the style
// tags into IE.
        var jStyleDiv = $( "<div>" ).append(
            $( "style" ).clone()
        );

// Write the HTML for the document. In this, we will
// write out the HTML of the current element.
        objDoc.open();
        objDoc.write( "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">" );
//        objDoc.write( "<html>" );
//        objDoc.write( "<body>" );
//        objDoc.write( "<head>" );
//        objDoc.write( "<title>" );
        objDoc.write( document.title );
        objDoc.write( "</title>" );
        objDoc.write( jStyleDiv.html() );
        objDoc.write( "</head>" );
        objDoc.write( this.html() );
        objDoc.write( "</body>" );
        objDoc.write( "</html>" );
        objDoc.close();

// Print the document.
        objFrame.focus();
        objFrame.print();

// Have the frame remove itself in about a minute so that
// we don't build up too many of these frames.
        setTimeout(
            function(){
                jFrame.remove();
            },
            (30 * 1000)
        );
    }
</script>
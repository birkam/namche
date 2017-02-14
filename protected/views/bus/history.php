<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/print/print.js"></script>
<?php
/**
 * Created by PhpStorm.
 * User: SANIL
 * Date: 1/26/15
 * Time: 12:52 PM
 */

$bus_id = $_GET['id'];

$tbl_file_assignbus = FileAssignbus::model()->findAllByAttributes(array('bus_id'=>$bus_id));
$bus = Bus::model()->findByPk($bus_id);


$busInsurance = BusInsurance::model()->findAllByAttributes(array('bus_id'=>$bus_id));

$driverInfo = BusAndDriver::model()->findAllByAttributes(array('bus_id'=>$bus_id));
?>
<div class="printable">
    <div class="title"><h5>Bus History of <strong><?php echo strtoupper($bus->bus_no);?></strong></h5></div>

    <fieldset>
        <div class="widget first">
            <div class="head"><h5 class="iList">Driver History of <strong><?php echo strtoupper($bus->bus_no);?></strong></h5></div>

            <table cellpadding="0" cellspacing="0" width="100%" class="tableStatic">
                <thead>
                <tr>
                    <td width="5%">SN</td>
                    <td width="15%">Bus No</td>
                    <td width="20%">Driver Name</td>
                    <td width="10%">Licence No</td>
                    <td width="10%">Driver Status</td>
                    <td width="20%">Driver Entered Date</td>
                    <td width="20%">Driver Left Date</td>
                </tr>
                </thead>
                <tbody>
                <?php
                $sn = 1;
                if(!empty($driverInfo)){
                    foreach($driverInfo as $driver){
                        $driverInfo = DriverInfo::model()->findByPk($driver->driver_id);
                        echo '<tr>';
                        echo '<td>'.$sn.'</td>';
                        echo '<td>'.strtoupper($bus->bus_no).'</td>';
                        echo '<td>'.ucwords(strtolower($driverInfo->fname.' '.$driverInfo->mname.' '.$driverInfo->lname)).'</td>';
                        echo '<td>'.strtoupper($driverInfo->licence_no).'</td>';
                        echo '<td>'.$driver->driver_status.'</td>';
                        echo '<td>'.$driver->driver_entered_date.'</td>';
                        echo '<td>'.$driver->driver_left_date.'</td>';
                        echo '</tr>';
                        $sn=$sn+1;
                    }
                }
                ?>

                </tbody>
            </table>


        </div>
    </fieldset>
<br/>
    <fieldset>
        <div class="widget first">
            <div class="head"><h5 class="iList">Insurance History of <strong><?php echo strtoupper($bus->bus_no);?></strong></h5></div>


            <table cellpadding="0" cellspacing="0" width="100%" class="tableStatic">
                <thead>
                <tr>
                    <td width="5%">SN</td>
                    <td width="10%">Bus No</td>
                    <td width="10%">Insurance Company</td>
                    <td width="10%">Insurance Account</td>
                    <td width="10%">A/c Holder</td>
                    <td width="10%">T.I No.</td>
                    <td width="10%">Policy No.</td>
                    <td width="10%">Issue Date</td>
                    <td width="10%">Expiry Date</td>
                    <td width="10%">Remarks</td>
                </tr>
                </thead>
                <tbody>
                <?php
                $sn = 1;
                if(!empty($busInsurance)){
                    foreach($busInsurance as $busIns){
                        echo '<tr>';
                        echo '<td>'.$sn.'</td>';
                        echo '<td>'.strtoupper($bus->bus_no).'</td>';
                        echo '<td>'.$busIns->insurance_company.'</td>';
                        echo '<td>'.$busIns->insurance_account.'</td>';
                        echo '<td>'.$busIns->ac_holder_name.'</td>';
                        echo '<td>'.$busIns->tax_invoice_no.'</td>';
                        echo '<td>'.$busIns->police_no.'</td>';
                        echo '<td>'.$busIns->issue_date.'</td>';
                        echo '<td>'.$busIns->expiry_date.'</td>';
                        echo '<td>'.$busIns->remarks.'</td>';
                        echo '</tr>';
                        $sn=$sn+1;
                    }
                }
                ?>

                </tbody>
            </table>


        </div>
    </fieldset>
    <br/>
    <fieldset>
        <div class="widget first">
            <div class="head"><h5 class="iList">Bus, File No and Owner</h5></div>


            <table cellpadding="0" cellspacing="0" width="100%" class="tableStatic">
                <thead>
                <tr>
                    <td width="5%">SN</td>
                    <td width="5%">File No</td>
                    <td width="10%">Bus Status</td>
                    <td width="40%">Owners</td>
                    <td width="20%">Bus Entered Date</td>
                    <td width="20%">Taken Out Date</td>
                </tr>
                </thead>
                <tbody>
                <?php
                $sn = 1;
                $fileno_id_arr = array();
                foreach($tbl_file_assignbus as $file_assignbus){
                    $owner_id_str = $file_assignbus->owner_id;
                    $owner_id_arr = explode(', ', $owner_id_str);
                    $owners = BusOwner::model()->findAllByAttributes(array('id'=>$owner_id_arr));
                    //var_dump($owners);
//    echo $file_assignbus->fileno_id.'<br>';
                    $fileno_id_arr[] = $file_assignbus->fileno_id;
                    echo '<tr>';
                    $file_no = FileNo::model()->findByPk($file_assignbus->fileno_id);
                    echo '<td>'.$sn.'</td>';
                    echo '<td>'.$file_no->file_no.'</td>';
                    echo '<td>'.$file_assignbus->bus_status.'</td>';
                    echo '<td>';
                    foreach($owners as $own){
                        echo ucwords(strtolower($own->fname.' '.$own->mname.' '.$own->lname)).', </br>';
                    }
                    echo '</td>';
                    echo '<td>'.$file_assignbus->bus_entered_date.'</td>';
                    echo '<td>'.$file_assignbus->taken_out_date.'</td>';
                    echo '</tr>';
                    $sn=$sn+1;
                }
                ?>

                </tbody>
            </table>


        </div>
    </fieldset>

    <!--    --><?php
    //    $tbl_fileno_bus = FilenoBus::model()->findAllByAttributes(array('fileno_id'=>$fileno_id_arr));
    //
    //
    //    ?>
    <!--    <fieldset>-->
    <!--        <div class="widget first">-->
    <!--            <div class="head"><h5 class="iList">Bus And Owner</h5></div>-->
    <!---->
    <!---->
    <!--            <table cellpadding="0" cellspacing="0" width="100%" class="tableStatic">-->
    <!--                <thead>-->
    <!--                <tr>-->
    <!--                    <td width="5%">SN</td>-->
    <!--                    <td width="15%">Bus Owner</td>-->
    <!--                    <td width="15%">Owner Status</td>-->
    <!--                    <td width="15%">Owned Date</td>-->
    <!--                    <td width="15%">Left Date</td>-->
    <!--                </tr>-->
    <!--                </thead>-->
    <!--                <tbody>-->
    <!--                --><?php
    //                $sn = 1;
    //                foreach($tbl_fileno_bus as $fileno_bus){
    //                    $busOwner = BusOwner::model()->findByPk($fileno_bus->owner_id);
    //                    if($fileno_bus->owner_status == 1){
    //                        $stat = '<span style="color:green;">ACTIVE</span>';
    //                    }elseif($fileno_bus->owner_status == 0){
    //                        $stat = '<span style="color:red;">INACTIVE</span>';
    //                    }
    //                    echo '<tr>';
    //                    echo '<td>'.$sn.'</td>';
    //                    echo '<td>'.$busOwner->fname.' '.$busOwner->mname.' '.$busOwner->lname.'</td>';
    //                    echo '<td>'.$stat.'</td>';
    //                    echo '<td>'.$fileno_bus->owned_date.'</td>';
    //                    echo '<td>'.$fileno_bus->left_date.'</td>';
    //                    echo '</tr>';
    //                    $sn=$sn+1;
    //                }
    //                ?>
    <!---->
    <!--                </tbody>-->
    <!--            </table>-->
    <!---->
    <!---->
    <!--        </div>-->
    <!--    </fieldset>-->
</div>
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

</script>
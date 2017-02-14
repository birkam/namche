<?php
/**
 * Created by PhpStorm.
 * User: SANIL
 * Date: 1/21/15
 * Time: 1:42 PM
 */
$driverId = $_GET['id'];
$driverInfo = DriverInfo::model()->findByPk($driverId);
?>
<div class="content">
    <div class="title"><h5>Driver</h5></div>
    <!-- USer Profile navigation -->
    <div class="leftNav">

        <ul class="sub">
            <!-- <li> -->
            <a href="#" title="">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/BusDriver/<?php echo $driverId;?>/<?php echo $driverInfo->photo;?>" width="208" height="200">
            </a>
            <!-- </li> -->
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/DriverInfo/<?php echo $driverId;?>" title=""  class="active">General Information</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/DriverInfo/EmContact/<?php echo $driverId;?>" title="">Emergency Contact</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/DriverInfo/LicenceInfo/<?php echo $driverId;?>" title="">Licence Information</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/DriverInfo/Update/<?php echo $driverId;?>" title="">Update All</a></li>
        </ul>

    </div>

    <fieldset>
        <div class="widget first">
            <div class="head"><h5 class="iList">Licence Information</h5></div>
            <div class="rowElem">
                <label>Licence No:</label>
                <div class="formRight">
                    <?php echo ucwords(strtolower($driverInfo->licence_no));?>
                </div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>Licence Issue Date :</label>
                <div class="formRight">
                    <?php echo ucwords(strtolower($driverInfo->licence_issue_date));?>
                </div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>Licence Exp Date:</label>
                <div class="formRight">
                    <?php echo ucwords(strtolower($driverInfo->licence_exp_date));?>
                </div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>Citizenship No:</label>
                <div class="formRight">
                    <?php echo ucwords(strtolower($driverInfo->citizenship_no));?>
                </div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>Blood Group :</label>
                <div class="formRight">
                    <?php echo ucwords(strtolower($driverInfo->blood_group));?>
                </div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>Authorize To Drive:</label>
                <div class="formRight">
                    <?php
                    $selectedVeh = $driverInfo->licence_authorized_drive;
                    $selectedVehArr = explode(', ', $selectedVeh);
                    $selectedVehArrOrder = array_keys(array_count_values($selectedVehArr));//it works as array_unique with key re-arranging in increment orders;

                    foreach($selectedVehArrOrder as $key=>$val){
                        $vehicles = Vehicles::model()->findByPk($val);
                        $vehicleInfo = $vehicles->category.'. '.$vehicles->vehicles;
                        echo ucwords(strtolower($vehicleInfo)).'<br>';
                    }
                    ?>
                </div>
                <div class="fix"></div>
            </div>

            <div class="rowElem">
                <a href="<?php echo Yii::app()->controller->createUrl("/DriverInfo/Update",array("id"=>$driverInfo->id))?>">
                    <input type="submit" value="Edit" class="greyishBtn " />
                </a>
            </div>
            <div class="fix"></div>

        </div>
    </fieldset>
</div>
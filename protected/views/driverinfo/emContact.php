<?php
/**
 * Created by PhpStorm.
 * User: SANIL
 * Date: 1/21/15
 * Time: 1:43 PM
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
            <div class="head"><h5 class="iList">Emergency Contact</h5></div>
            <div class="rowElem">
                <label>Name:</label>
                <div class="formRight">
                    <?php echo ucwords(strtolower($driverInfo->em_contact_name));?>
                </div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>Relation :</label>
                <div class="formRight">
                    <?php echo ucwords(strtolower($driverInfo->em_contact_relation));?>
                </div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>Contact Number:</label>
                <div class="formRight">
                    <?php echo ucwords(strtolower($driverInfo->em_contact_number));?>
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
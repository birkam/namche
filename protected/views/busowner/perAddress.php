<?php
$ownerId = $_GET['id'];
$busOwner = BusOwner::model()->findByPk($ownerId);
//$perAddress = PerAddress::model()->findByAttributes(array('busOwnerId'=>$ownerId));

$sql = "SELECT zone_name FROM tbl_zone WHERE id= '$busOwner->per_zone' ";
$command = Yii::app()->db->createCommand($sql);
$zone= $command->queryScalar();

$sql = "SELECT district_name FROM tbl_district WHERE id= '$busOwner->per_district' ";
$command = Yii::app()->db->createCommand($sql);
$district= $command->queryScalar();

$sql = "SELECT vdc_municipality FROM tbl_vdc_municipality WHERE id= '$busOwner->per_vdc_municipality' ";
$command = Yii::app()->db->createCommand($sql);
$vdc_municipality= $command->queryScalar();
?>
<div class="content">
    <div class="title"><h5>Register Bus</h5></div>
    <!-- USer Profile navigation -->
    <div class="leftNav">

        <ul class="sub">
            <!-- <li> -->
            <a href="#" title="">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/BusOwner/<?php echo $ownerId;?>/<?php echo $busOwner->photo;?>" width="208" height="200">
            </a>
            <!-- </li> -->
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/busOwner/<?php echo $ownerId;?>" title=""  class="active">Owner Information</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/busOwner/TempAddress/<?php echo $ownerId;?>" title="">Temporary Address</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/busOwner/PerAddress/<?php echo $ownerId;?>" title="">Permanent Address</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/busOwner/Attachments/<?php echo $ownerId;?>" title="">Attachments</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/busOwner/ContactInfo/<?php echo $ownerId;?>" title="">Contact Information</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/busOwner/EmContactInfo/<?php echo $ownerId;?>" title="">Emergency Contact Information</a></li>
            <li><a href="queueinfo.html" title="">Queue Information</a></li>
            <li><a href="membership.html" title="">Membership</a></li>
        </ul>

    </div>

    <fieldset>
        <div class="widget first">
            <div class="head"><h5 class="iList">Owner Permanent Address</h5></div>
            <div class="rowElem ">
                <label>Zone:</label>
                <div class="formRight">
                    <?php echo ucwords(strtolower($zone));?>
                </div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>District :</label>
                <div class="formRight">
                    <?php echo ucwords(strtolower($district));?>
                </div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>VDC/Municipality :</label>
                <div class="formRight">
                    <?php echo ucwords(strtolower($vdc_municipality));?>
                </div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>Ward:</label>
                <div class="formRight">
                    <?php echo ucwords(strtolower($busOwner->per_ward));?>
                </div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>Tole:</label>
                <div class="formRight">
                    <?php echo ucwords(strtolower($busOwner->per_tole));?>
                </div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>House No:</label>
                <div class="formRight">
                    <?php echo ucwords(strtolower($busOwner->per_house_no));?>
                </div>
                <div class="fix"></div>
            </div>

            <div class="rowElem">
                <a href="<?php //echo Yii::app()->controller->createUrl("/PerAddress/Update",array("owner_id"=>$ownerId))?>">
                    <input type="submit" value="Edit" class="greyishBtn " />
                </a>
            </div>
            <div class="fix"></div>

        </div>
    </fieldset>




</div>
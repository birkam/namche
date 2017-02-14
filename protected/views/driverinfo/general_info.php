<?php
/**
 * Created by PhpStorm.
 * User: SANIL
 * Date: 1/21/15
 * Time: 1:24 PM
 */

?>
<div class="content">
    <div class="title"><h5>Driver</h5></div>
    <!-- USer Profile navigation -->
    <div class="leftNav">

        <ul class="sub">
            <!-- <li> -->
            <a href="#" title="">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/BusDriver/<?php echo $model->id;?>/<?php echo $model->photo;?>" width="208" height="200">
            </a>
            <!-- </li> -->
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/DriverInfo/<?php echo $model->id;?>" title=""  class="active">General Information</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/DriverInfo/EmContact/<?php echo $model->id;?>" title="">Emergency Contact</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/DriverInfo/LicenceInfo/<?php echo $model->id;?>" title="">Licence Information</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/DriverInfo/Update/<?php echo $model->id;?>" title="">Update All</a></li>
        </ul>

    </div>

    <fieldset>
        <div class="widget first">
            <div class="head"><h5 class="iList">General Information</h5></div>
            <div class="rowElem">
                <label>Owner Name:</label>
                <div class="formRight">
                    <?php echo ucwords(strtolower($model->fname.' '.$model->mname.' '.$model->lname));?>
                </div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>Gender :</label>
                <div class="formRight">
                    <?php echo ucwords(strtolower($model->gender));?>
                </div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>Marital Status:</label>
                <div class="formRight">
                    <?php echo ucwords(strtolower($model->address));?>
                </div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>Date of Birth:</label>
                <div class="formRight">
                    <?php echo ucwords(strtolower($model->date_of_birth));?>
                </div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>Nationality:</label>
                <div class="formRight">
                    <?php echo ucwords(strtolower($model->mobile));?>
                </div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>Nationality:</label>
                <div class="formRight">
                    <?php echo ucwords(strtolower($model->landline));?>
                </div>
                <div class="fix"></div>
            </div>

            <div class="rowElem">
                <a href="<?php echo Yii::app()->controller->createUrl("/DriverInfo/Update",array("id"=>$model->id))?>">
                    <input type="submit" value="Edit" class="greyishBtn " />
                </a>
            </div>
            <div class="fix"></div>

        </div>
    </fieldset>




</div>
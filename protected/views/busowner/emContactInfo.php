<?php
$busOwner = BusOwner::model()->findByPk($model->id);
$emContactInfo = BusOwnerEmergencyContact::model()->findByAttributes(array('busOwnerId'=>$model->id));

?>

<fieldset>
    <div class="widget first">
        <div class="head"><h5 class="iList">Owner Emergency Contact</h5></div>
        <div class="rowElem">
            <label>Name :</label>
            <div class="formRight">
                <?php echo ucwords(strtolower($emContactInfo->name));?>
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem">
            <label>Relationship :</label>
            <div class="formRight">
                <?php echo ucwords(strtolower($emContactInfo->relationship));?>
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem">
            <label>Mobile No. :</label>
            <div class="formRight">
                <?php echo strtolower($emContactInfo->mobile_no);?>
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem">
            <label>Landline :</label>
            <div class="formRight">
                <?php echo ucwords(strtolower($emContactInfo->landline));?>
            </div>
            <div class="fix"></div>
        </div>

        <div class="rowElem">
            <a href="<?php echo Yii::app()->controller->createUrl("/BusOwnerEmergencyContact/Update",array("owner_id"=>$model->id))?>">
                <input type="submit" value="Edit" class="greyishBtn " />
            </a>
        </div>
        <div class="fix"></div>

    </div>
</fieldset>

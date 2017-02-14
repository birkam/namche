<?php
$busOwner = BusOwner::model()->findByPk($model->id);
$contactInfo = BusOwnerContact::model()->findByAttributes(array('busOwnerId'=>$model->id));

?>
<fieldset>
    <div class="widget first">
        <div class="head"><h5 class="iList">Owner Contact</h5></div>
        <div class="rowElem">
            <label>Mobile :</label>
            <div class="formRight">
                <?php echo ucwords(strtolower($contactInfo->mobile));?>
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem">
            <label>Landline :</label>
            <div class="formRight">
                <?php echo ucwords(strtolower($contactInfo->landline));?>
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem">
            <label>E-mail :</label>
            <div class="formRight">
                <?php echo strtolower($contactInfo->email);?>
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem">
            <label>Work Phone :</label>
            <div class="formRight">
                <?php echo ucwords(strtolower($contactInfo->workPhone));?>
            </div>
            <div class="fix"></div>
        </div>

        <div class="rowElem">
            <a href="<?php echo Yii::app()->controller->createUrl("/BusOwnerContact/Update",array("owner_id"=>$model->id))?>">
                <input type="submit" value="Edit" class="greyishBtn " />
            </a>
        </div>
        <div class="fix"></div>

    </div>
</fieldset>

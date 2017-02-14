<?php
$busOwner = BusOwner::model()->findByPk($model->id);
$attachments = BusownerAttachments::model()->findAllByAttributes(array('busOwnerId'=>$model->id));

?>

<fieldset>
    <div class="widget first">
        <div class="head"><h5 class="iList">Owner Attachments</h5></div>
        <div class="rowElem ">
            <label>Attachments:</label>
            <?php
            if(!empty($attachments)){
                foreach($attachments as $attachment){
                    $image = $attachment->image;
                    $description = $attachment->description;
                    ?>
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/BusOwner/<?php echo $model->id;?>/Attachments/<?php echo $image?>" alt="<?php echo ucwords(strtolower($image));?>" width="208" height="200">
                    <div class="formRight">

                    </div>


                <?php }}?>

            <div class="fix"></div>
        </div>
        <div class="rowElem">
            <label>Description :</label>
            <div class="formRight">
                <?php if(!empty($description)){ echo ucwords(strtolower($description));}?>
            </div>
            <div class="fix"></div>
        </div>

        <div class="rowElem" style="display: none">
            <a href="<?php echo Yii::app()->controller->createUrl("/BusownerAttachments/Update",array("owner_id"=>$model->id))?>">
                <input type="submit" value="Edit" class="greyishBtn " />
            </a>
        </div>
        <div class="fix"></div>

    </div>
</fieldset>

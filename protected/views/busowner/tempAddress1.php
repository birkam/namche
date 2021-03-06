<?php $model->id = $_GET['id'];
$busOwner = BusOwner::model()->findByPk($model->id);
$tempAddress = TempAddress::model()->findByAttributes(array('busOwnerId'=>$model->id));

$sql = "SELECT zone_name FROM tbl_zone WHERE id= '$tempAddress->zone' ";
$command = Yii::app()->db->createCommand($sql);
$zone= $command->queryScalar();

$sql = "SELECT district_name FROM tbl_district WHERE id= '$tempAddress->district' ";
$command = Yii::app()->db->createCommand($sql);
$district= $command->queryScalar();

$sql = "SELECT vdc_municipality FROM tbl_vdc_municipality WHERE id= '$tempAddress->vdc_municipality' ";
$command = Yii::app()->db->createCommand($sql);
$vdc_municipality= $command->queryScalar();
?>
    <fieldset>
        <div class="widget first">
            <div class="head"><h5 class="iList">Owner Temporary Address</h5></div>
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
                <label>VDC/Municipality:</label>
                <div class="formRight">
                    <?php echo ucwords(strtolower($vdc_municipality));?>
                </div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>Ward:</label>
                <div class="formRight">
                    <?php echo ucwords(strtolower($tempAddress->ward));?>
                </div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>Tole:</label>
                <div class="formRight">
                    <?php echo ucwords(strtolower($tempAddress->tole));?>
                </div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>House No:</label>
                <div class="formRight">
                    <?php echo ucwords(strtolower($tempAddress->house_no));?>
                </div>
                <div class="fix"></div>
            </div>

            <div class="rowElem">
                <a href="<?php echo Yii::app()->controller->createUrl("/TempAddress/Update",array("owner_id"=>$model->id))?>">
                    <input type="submit" value="Edit" class="greyishBtn " />
                </a>
            </div>
            <div class="fix"></div>

        </div>
    </fieldset>

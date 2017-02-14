    <fieldset>
        <div class="widget first">
            <div class="head"><h5 class="iList">Owner Information</h5></div>
            <div class="rowElem ">
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
                    <?php echo ucwords(strtolower($model->marital_status));?>
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
                    <?php echo ucwords(strtolower($model->nationality));?>
                </div>
                <div class="fix"></div>
            </div>

            <div class="rowElem">
                <a href="<?php echo Yii::app()->controller->createUrl("/BusOwner/Update",array("id"=>$model->id))?>">
                    <input type="submit" value="Edit" class="greyishBtn " />
                </a>
            </div>
            <div class="fix"></div>

        </div>
    </fieldset>
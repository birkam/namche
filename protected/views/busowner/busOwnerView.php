<div class="content">
    <div class="title"><h5>Register Bus</h5></div>
    <!-- USer Profile navigation -->
    <div class="leftNav">

        <ul class="sub">
            <!-- <li> -->
            <a href="#" title="">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/BusOwner/<?php echo $model->id;?>/<?php echo $model->photo;?>" width="208" height="200">
            </a>
            <!-- </li> -->
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/busOwner/<?php echo $model->id;?>?ref=oi" title="" <?php if(@$_GET['ref']=='oi'){?>class="active"<?php }?>>Owner Information</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/busOwner/<?php echo $model->id;?>?ref=ta" title="" <?php if(@$_GET['ref']=='ta'){?>class="active"<?php }?>>Temporary Address</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/busOwner/<?php echo $model->id;?>?ref=pa" title="" <?php if(@$_GET['ref']=='pa'){?>class="active"<?php }?>>Permanent Address</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/busOwner/<?php echo $model->id;?>?ref=a" title="" <?php if(@$_GET['ref']=='a'){?>class="active"<?php }?>>Attachments</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/busOwner/<?php echo $model->id;?>?ref=ci" title="" <?php if(@$_GET['ref']=='ci'){?>class="active"<?php }?>>Contact Information</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/busOwner/<?php echo $model->id;?>?ref=eci" title="" <?php if(@$_GET['ref']=='eci'){?>class="active"<?php }?>>Emergency Contact Information</a></li>
        </ul>

    </div>

    <?php
    if(@$_GET['ref']=='oi')
        include('busOwnerView1.php');
    if(@$_GET['ref']=='pa')
        include('perAddress1.php');
    if(@$_GET['ref']=='ta')
        include('tempAddress1.php');
    if(@$_GET['ref']=='a')
        include('attachments.php');
    if(@$_GET['ref']=='ci')
        include('contactInfo.php');
    if(@$_GET['ref']=='eci')
        include('emContactInfo.php');
    ?>
    <!--    <fieldset>
        <div class="widget first">
            <div class="head"><h5 class="iList">Owner Information</h5></div>
            <div class="rowElem ">
                <label>Owner Name:</label>
                <div class="formRight">
                    <?php /*echo ucwords(strtolower($model->fname.' '.$model->mname.' '.$model->lname));*/?>
                </div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>Gender :</label>
                <div class="formRight">
                    <?php /*echo ucwords(strtolower($model->gender));*/?>
                </div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>Marital Status:</label>
                <div class="formRight">
                    <?php /*echo ucwords(strtolower($model->marital_status));*/?>
                </div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>Date of Birth:</label>
                <div class="formRight">
                    <?php /*echo ucwords(strtolower($model->date_of_birth));*/?>
                </div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>Nationality:</label>
                <div class="formRight">
                    <?php /*echo ucwords(strtolower($model->nationality));*/?>
                </div>
                <div class="fix"></div>
            </div>

            <div class="rowElem">
                <a href="<?php /*echo Yii::app()->controller->createUrl("/BusOwner/Update",array("id"=>$model->id))*/?>">
                    <input type="submit" value="Edit" class="greyishBtn " />
                </a>
            </div>
            <div class="fix"></div>

        </div>
    </fieldset>-->




</div>
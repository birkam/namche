<?php
/**
 * Created by PhpStorm.
 * User: SANIL
 * Date: 4/29/15
 * Time: 2:24 PM
 */ ?>
<fieldset>
    <div class="widget first">
        <div class="head"><h5 class="iList">General Details</h5></div>
        <div class="rowElem ">
            <label>Name:</label>
            <div class="formRight">
                <?php echo ucwords(strtolower($model->name));?>
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem">
            <label>Address:</label>
            <div class="formRight">
                <?php echo ucwords(strtolower($model->address));?>
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem">
            <label>Email:</label>
            <div class="formRight">
                <?php echo strtolower($model->email);?>
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem">
            <label>Phone:</label>
            <div class="formRight">
                <?php echo $model->phone;?>
            </div>
            <div class="fix"></div>
        </div>
        <div class="fix"></div>

    </div>
</fieldset>
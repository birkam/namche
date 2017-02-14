<?php
$userAcId = $model->id;
$userDetId = $model->user_id;
$userDetails = UserDetails::model()->findByPk($userDetId);
$userFullName = $userDetails->name;
$status =  $model->status;
if($status == 1){
    $st = 'Active';
}elseif($status == 2){
    $st = 'Inactive';
}
$created_by_id = $model->created_by;
$created_by_details = UserAccount::model()->findByPk($created_by_id);
$creatd_by_uname = $created_by_details->user_name;
?>
<div class="title"><h5>User Account</h5></div>
<fieldset>
    <div class="widget first">
        <div class="head"><h5 class="iList">User Account Details</h5></div>
        <div class="rowElem ">
            <label>Name:</label>
            <div class="formRight">
                <?php echo ucwords(strtolower($userFullName));?>
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem">
            <label>Email:</label>
            <div class="formRight">
                <?php echo $model->email;?>
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem">
            <label>User Name:</label>
            <div class="formRight">
                <?php echo $model->user_name;?>
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem">
            <label>Password:</label>
            <div class="formRight">
                *********************
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem">
            <label>Role:</label>
            <div class="formRight">
                <?php echo $model->role;?>
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem">
            <label>Status:</label>
            <div class="formRight">
                <?php echo $st;?>
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem">
            <label>Created By:</label>
            <div class="formRight">
                <?php echo $creatd_by_uname;?>
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem">
            <label>Created Date:</label>
            <div class="formRight">
                <?php echo $model->created_date;?>
            </div>
            <div class="fix"></div>
        </div>
        <div class="fix"></div>

    </div>
</fieldset>
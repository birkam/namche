<div class="title"><h5>User Profile</h5></div>
<!-- USer Profile navigation -->
<div class="leftNav">

    <ul class="sub">
        <!-- <li> -->
        <a href="#" title="">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/UserPhoto/<?php echo $model->id.'/'.$model->photo;?>" width="208" height="200">
        </a>
        <!-- </li> -->
        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/UserDetails/<?php echo $model->id?>?ref=gd" title="" <?php if(@$_GET['ref']=='gd'){?>class="active"<?php }?>>General Details</a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/UserDetails/<?php echo $model->id?>?ref=ec" title="" <?php if(@$_GET['ref']=='ec'){?>class="active"<?php }?>>Emergency Contacts</a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/UserDetails/<?php echo $model->id?>?ref=qf" title="" <?php if(@$_GET['ref']=='qf'){?>class="active"<?php }?>>Qualifications</a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/UserDetails/<?php echo $model->id?>?ref=en" title="" <?php if(@$_GET['ref']=='en'){?>class="active"<?php }?>>Enrollment</a></li>
    </ul>

</div>
<?php
if(@$_GET['ref']=='gd')
    include('generalDetail.php');
if(@$_GET['ref']=='ec')
    include('emergencyContacts.php');
if(@$_GET['ref']=='qf')
    include('qualification.php');
if(@$_GET['ref']=='en')
    include('enrollment.php');
?>
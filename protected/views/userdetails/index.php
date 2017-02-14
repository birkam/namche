<?php
$this->breadcrumbs=array(
    'User Details',
);

$this->menu=array(
    array('label'=>'Create UserDetails','url'=>array('create')),
    array('label'=>'Manage UserDetails','url'=>array('admin')),
);
?>
<div class="widget">
    <div class="head"><h5 class="iImage2">User Management</h5></div>
    <div class="body aligncenter">
        <a href="<?php echo Yii::app()->request->baseUrl; ?>/UserDetails/Create" title="" class="btnIconLeft mr10"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/dark/image2.png" alt="" class="icon"><span>Create User</span></a>
        <a href="<?php echo Yii::app()->request->baseUrl; ?>/UserDetails/Admin" title="" class="btnIconLeft mr10"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/dark/priceTag.png" alt="" class="icon"><span>Role Management</span></a>
    </div>
</div>

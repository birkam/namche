<!-- Content -->
<div class="content">
    <!--    --><?php //echo $content; ?>
    <div class="title"><h5>Project Namche</h5></div>
    <!--route management menu tav goes here **-->
    <div class="widget">
        <div class="head"><h5 class="iImage2">Daily</h5></div>
        <div class="body aligncenter">
            <a href="<?php echo Yii::app()->request->baseUrl; ?>/dailybusqueue/dailyall" title="" class="btnIconLeft mr10"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/dark/image2.png" alt="" class="icon"><span>Daily All</span></a>
            <a href="<?php echo Yii::app()->request->baseUrl; ?>/dailybusqueue/dailyroute" title="" class="btnIconLeft mr10"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/dark/image2.png" alt="" class="icon"><span>Daily Route</span></a>
        </div>
    </div>

    <!--Bus, Owner and File no ** -->
    <div class="widget">
        <div class="head"><h5 class="iImage2">Periodic</h5></div>

        <div class="body aligncenter">
            <a href="<?php echo Yii::app()->request->baseUrl; ?>/dailybusqueue/monthlyall" title="" class="btnIconLeft mr10"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/dark/image2.png" alt="" class="icon"><span>Monthly</span></a>
            <a href="<?php echo Yii::app()->request->baseUrl; ?>/dailybusqueue/range" title="" class="btnIconLeft mr10"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/dark/image2.png" alt="" class="icon"><span>Time Range</span></a>
        </div>
    </div>
</div>

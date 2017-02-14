
<!--route management menu tav goes here **-->
<div class="widget">
    <div class="head"><h5 class="iRoute">Route Management</h5></div>
    <div class="body aligncenter">
        <a href="<?php echo Yii::app()->request->baseUrl; ?>/Route/Create" title="" class="btnIconLeft mr10"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/dark/route_add.png" alt="" class="icon"><span>Create Route</span></a>
        <a href="<?php echo Yii::app()->request->baseUrl; ?>/Route/Admin?mod=rtac" title="" class="btnIconLeft mr10"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/dark/time_money.png" alt="" class="icon"><span>Route Time & Cost</span></a>
        <a href="<?php echo Yii::app()->request->baseUrl; ?>/Route/Admin?mod=bir" title="" class="btnIconLeft mr10"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/dark/route_bus.png" alt="" class="icon"><span>Bus In Route</span></a>
        <a href="<?php echo Yii::app()->request->baseUrl; ?>/Route/Admin?mod=bq" title="" class="btnIconLeft mr10"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/dark/bus_queue.png" alt="" class="icon"><span>Bus Queue Format</span></a>
        <a href="<?php echo Yii::app()->request->baseUrl; ?>/Route/Admin?mod=dbq" title="" class="btnIconLeft"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/dark/daily_queue.png" alt="" class="icon"><span>Daily Bus Queue</span></a>
        <a href="<?php echo Yii::app()->request->baseUrl; ?>/BusRemovedFrmQueue/Admin" title="" class="btnIconLeft"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/dark/sound.png" alt="" class="icon"><span>Bus Removed</span></a>
        <a href="<?php echo Yii::app()->request->baseUrl; ?>/DailyBusQueue/Admin" title="" class="btnIconLeft"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/dark/sound.png" alt="" class="icon"><span>View Queues</span></a></div>
</div>
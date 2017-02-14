<!-- Content -->
<div class="content">
    <div class="title"><h5>:: Namche Sewa :: DASHBOARD</h5></div>
    <!--route management menu tav goes here **-->
    <div class="widget">
        <div class="head"><h5 class="iRoute">Route Management</h5></div>
        <div class="body aligncenter">
            <a href="<?php echo Yii::app()->request->baseUrl; ?>/Route/Create" title="" class="btnIconLeft mr10"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/dark/route_add.png" alt="" class="icon"><span>Create Route</span></a>
            <a href="<?php echo Yii::app()->request->baseUrl; ?>/Route/Admin?mod=rtac" title="" class="btnIconLeft mr10"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/dark/time_money.png" alt="" class="icon"><span>Route Time & Cost</span></a>
            <a href="<?php echo Yii::app()->request->baseUrl; ?>/Route/Admin?mod=bir" title="" class="btnIconLeft mr10"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/dark/route_bus.png" alt="" class="icon"><span>Bus In Route</span></a>
            <a href="<?php echo Yii::app()->request->baseUrl; ?>/Route/Admin?mod=bq" title="" class="btnIconLeft mr10"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/dark/bus_queue.png" alt="" class="icon"><span>Bus Queue Format</span></a>
            <a href="<?php echo Yii::app()->request->baseUrl; ?>/Route/Admin?mod=dbq" title="" class="btnIconLeft"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/dark/daily_queue.png" alt="" class="icon"><span>Daily Bus Queue</span></a>
        </div>
    </div>
    <!--Bus, Owner and File no ** -->
    <div class="widget">
        <div class="head"><h5 class="iBus">Bus, Owner and File no Management</h5></div>
        <div class="body aligncenter">
            <a href="<?php echo Yii::app()->request->baseUrl; ?>/Bus/Create" title="" class="btnIconLeft mr10"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/middlenav/bus_register.png" alt="" class="icon"><span>Bus Register</span></a>
            <a href="<?php echo Yii::app()->request->baseUrl; ?>/BusOwner/Create" title="" class="btnIconLeft mr10"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/middlenav/owner.png" alt="" class="icon"><span>Owner Register</span></a>
            <a href="<?php echo Yii::app()->request->baseUrl; ?>/DriverInfo/Create" title="" class="btnIconLeft mr10"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/middlenav/driver.png" alt="" class="icon"><span>Driver Register</span></a>
            <a href="<?php echo Yii::app()->request->baseUrl; ?>/FileNo/Admin?mod=otf" title="" class="btnIconLeft mr10"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/middlenav/file_owner.png" alt="" class="icon"><span>Assign Owner to File no</span></a>
            <a href="<?php echo Yii::app()->request->baseUrl; ?>/FileNo/Admin?mod=btf" title="" class="btnIconLeft"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/middlenav/file_bus.png" alt="" class="icon"><span>Assign Bus to File no</span></a>
        </div>
    </div>
    <!--User management -->
    <div class="widget">
        <div class="head"><h5 class="iUsers">User Management</h5></div>
        <div class="body aligncenter">
            <a href="<?php echo Yii::app()->request->baseUrl; ?>/UserDetails/Create" title="" class="btnIconLeft mr10"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/dark/add_user.png" alt="" class="icon"><span>Create User</span></a>
            <a href="<?php echo Yii::app()->request->baseUrl; ?>/UserDetails/Admin" title="" class="btnIconLeft mr10"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/dark/user_roles.png" alt="" class="icon"><span>Role Management</span></a>
        </div>
    </div>
    <!--    Cost Configuration-->
    <div class="widget">
        <div class="head"><h5 class="iCost">Cost Configuration</h5></div>
        <div class="body aligncenter">
            <a href="<?php echo Yii::app()->request->baseUrl; ?>/CostConfiguration/Create" title="" class="btnIconLeft mr10"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/middlenav/create_cost.png" alt="" class="icon"><span>Cost Configuration</span></a>
            <a href="<?php echo Yii::app()->request->baseUrl; ?>/Bus/Admin?mod=ccc" title="" class="btnIconLeft mr10"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/dark/view_cost.png" alt="" class="icon"><span>Check Cost Configuration</span></a>
        </div>
    </div>
    <!--    Insurance management-->
    <div class="widget">
        <div class="head"><h5 class="iInsurance">Insurance</h5></div>
        <div class="body aligncenter">
            <a href="<?php echo Yii::app()->request->baseUrl; ?>/Bus/Admin?mod=ins" title="" class="btnIconLeft mr10"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/middlenav/bus_insurance.png" alt="" class="icon"><span>Bus Insurance</span></a>
            <a href="<?php echo Yii::app()->request->baseUrl; ?>/Bus/Admin?mod=exp" title="" class="btnIconLeft mr10"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/dark/insurance_expired.png" alt="" class="icon"><span>Expired Insurance</span></a>
        </div>
    </div>
</div>

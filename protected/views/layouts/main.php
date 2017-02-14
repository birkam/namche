<?php
$user=Yii::app()->user;
if(!$user->getIsGuest())
{
    $time= ($user->getState(CWebUser::AUTH_TIMEOUT_VAR) - time()+2)*1000;//converting to millisecs
    Yii::app()->clientScript->registerSCript('timeout','
     setTimeout(function(){
                  window.location="'.Yii::app()->createUrl("site/Logout").'"  ;
                },'.$time.')',CClientScript::POS_END);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <!--        favicon-->
    <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/NamcheLogoFinal.png" type="image/x-icon" />

    <title>Project Namche - Dashboard For PRMBSS</title>


    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />


    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/main1.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Cuprum' rel='stylesheet' type='text/css' />

    <div class="jsclass" id="jsclass">
             <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/flot/jquery.flot.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/flot/jquery.flot.orderBars.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/flot/jquery.flot.pie.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/flot/excanvas.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/flot/jquery.flot.resize.js"></script>

        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/tables/jquery.dataTables.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/tables/colResizable.min.js"></script>

        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/forms/forms.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/forms/autogrowtextarea.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/forms/autotab.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/forms/jquery.validationEngine-en.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/forms/jquery.validationEngine.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/forms/jquery.dualListBox.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/forms/chosen.jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/forms/jquery.maskedinput.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/forms/jquery.inputlimiter.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/forms/jquery.tagsinput.min.js"></script>

        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/uploader/plupload.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/uploader/plupload.html5.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/uploader/plupload.html4.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/uploader/jquery.plupload.queue.js"></script>

        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/ui/jquery.progress.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/ui/jquery.jgrowl.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/ui/jquery.tipsy.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/ui/jquery.alerts.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/ui/jquery.colorpicker.js"></script>

        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/wizards/jquery.form.wizard.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/wizards/jquery.validate.js"></script>

        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/ui/jquery.breadcrumbs.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/ui/jquery.collapsible.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/ui/jquery.ToTop.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/ui/jquery.listnav.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/ui/jquery.sourcerer.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/ui/jquery.timeentry.min.js"></script>


        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.calendars.package/jquery.calendars.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.calendars.package/jquery.calendars.plus.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.calendars.package/jquery.calendars.picker.css">
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.calendars.package/jquery.plugin.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.calendars.package/jquery.calendars.picker.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.calendars.package/jquery.calendars.nepali.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.calendars.package/jquery.calendars.nepali-ne.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.calendars.package/jquery.calendars.nepali.min.js"></script>
        <style>
            .calendars-month-year{
                width: 6em;
            }
            .calendars-month-header select, .calendars-month-header input {
                font-size: 1em;
                width: 7em;
                height: 2em;
            }
            .calendars-month-header{
                height: 2em;
            }
            .drpDn { background: url(<?php echo Yii::app()->request->baseUrl; ?>/images/icons/topnav/tasks.png) no-repeat 15px 13px; }
        </style>
        <!--            <script type="text/javascript" src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/js/charts/chart.js"></script>-->
    </div>
    </head>

<body>
<?php $userDetails = UserDetails::model()->findByPk(Yii::app()->user->user_det_id); ?>
<!-- Top navigation bar -->
<div id="topNav">
    <div class="fixed">
        <div class="wrapper">
            <div class="welcome"><a href="<?php echo Yii::app()->request->baseUrl; ?>/userdetails/<?php echo(Yii::app()->user->user_det_id);?>" title=""><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/UserPhoto/<?php echo $userDetails->id.'/'.$userDetails->photo;?>" alt="" width="30px"/></a><span>Welcome, <?php echo(Yii::app()->user->name);?>!</span></div>
            <div class="userNav">
                <ul>
                    <li class="iStat"><a href="<?php echo Yii::app()->request->baseUrl; ?>/Activerecordlog/Admin"  title=""><span>View Log</span></a></li>
                    <li class="iStat"><a href=""  onclick="YNconfirm(); return false;" title=""><span>File Number</span></a></li>

                    <li class="nav-user dropdown">
                        <a href="#" title="" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/topnav/settings.png" alt="" />
                            <span>Settings</span>
                            <b class="caret" style="margin-top: 15px; color: #fff;"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/FileNo/CreateFileNo"  onclick="YNconfirm(); return false;" class="drpDn">File Number</a></li>
                            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/UserAccount/ChangePassword/<?php echo(Yii::app()->user->user_ac_id); ?>" class="drpDn">Change Password</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/site/Logout" title=""><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/topnav/logout.png" alt="" /><span>Logout</span></a></li>
                </ul>
            </div>
            <div class="fix"></div>
        </div>
    </div>
</div>
<?php

/*--------------------------Query to select bus_id of not expired insurance---------------------------------------------------*/
$criteria = new CDbCriteria();
$criteria->condition = 'expiry_date > :expiry_date';
$criteria->group = 'bus_id';
$criteria->order = 'expiry_date DESC';
$criteria->params = array('expiry_date' => date('Y-m-d'));
$notExpIns = BusInsurance::model()->findAll($criteria);
$notExpIns_arr = array();
foreach($notExpIns as $notExp){
    $notExpIns_arr[] = $notExp->bus_id;
}
$notExpIns_arr_filtered=array_keys(array_count_values($notExpIns_arr));
/*--------------------------Query ends here---------------------------------------------------*/

/*--------------------------Query to select bus_id of all insurance(expired and not expired)------------------------------------*/
$allIns_arr = array();
$allIns = Bus::model()->findAll();
foreach($allIns as $all){
    $allIns_arr[] = $all->id;
}
$allIns_arr_filtered=array_keys(array_count_values($allIns_arr));
/*--------------------------Query ends here---------------------------------------------------*/

$expiredIns_arr = array_diff($allIns_arr_filtered,$notExpIns_arr_filtered);
$total_expired_no = count($expiredIns_arr);
//           print_r($expiredIns_arr);exit;

//  $expNo = count($expIns);
?>
<!-- Header -->
<div id="header" class="wrapper">
    <div class="logo"><a href="<?php echo Yii::app()->request->baseUrl; ?>/site/Index" title=""><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/NamcheLogoFinal.png" alt="" style="margin-left: 70px" /></a></div>
    <div class="middleNav">
        <ul>
            <li class="iCost"><a href="<?php echo Yii::app()->request->baseUrl; ?>/CostConfiguration" title=""><span>Cost Configuration</span></a></li>
            <li class="iBus"><a href="<?php echo Yii::app()->request->baseUrl; ?>/Bus" title=""><span>Bus Management</span></a></li>
            <li class="iUserMan"><a href="<?php echo Yii::app()->request->baseUrl; ?>/UserDetails" title=""><span>User Management</span></a></li>
            <li class="iInsurance"><a href="<?php echo Yii::app()->request->baseUrl; ?>/BusInsurance" title=""><span>Insurance Management</span></a><span class="numberMiddle"><?php echo $total_expired_no;?></span></li>
            <li class="iRoute"><a href="<?php echo Yii::app()->request->baseUrl; ?>/Site/RouteManagement" title=""><span>Route Management</span></a></li>
            <li class="iReport"><a href="<?php echo Yii::app()->request->baseUrl; ?>/Site/ReportPanel" title="Report Panel"><span>Report Panel</span></a></li>
        </ul>
    </div>
    <div class="fix"></div>
</div>
<!-- Content wrapper -->
<div class="wrapper">

    <!-- Left navigation -->
    <div class="leftNav">
        <ul class="menu" id="menu">

            <li class="user">
                <a title="" class="exp" data-toggle="collapse" href="#usermngmt">
                    <span>User Management</span>
                </a>
                <ul id="usermngmt" class="sub collapse unstyled">
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/UserDetails/Create" title="">Create User</a></li>
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/UserDetails/Admin" title="">Role Management</a></li>
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/rights" title="">User Rights</a></li>
                </ul>
            </li>
            <li class="bus">
                <a title="" class="exp" data-toggle="collapse" href="#bus">
                    <span>Bus, Owner And File No</span>
                </a>
                <ul id="bus" class="sub collapse unstyled">
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/Bus/Create" title="">Bus Register</a></li>
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/BusOwner/Create" title="">Owner Register</a></li>
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/DriverInfo/Create" title="">Driver Register</a></li>
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/FileNo/Admin?mod=otf" title="">Assign Owner To File No</a></li>
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/FileNo/Admin?mod=btf" title="">Assign Bus To File No</a></li>
                </ul>
            </li>

            <li class="cost">
                <a title="" class="exp" data-toggle="collapse" href="#cost">
                    <span>Cost Configuration</span>
                </a>
                <ul id="cost" class="sub collapse unstyled">
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/CostConfiguration/Create" title="">Create Cost Configuration Register</a></li>
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/Bus/Admin?mod=ccc" title="">Check Cost Configuration</a></li>
                </ul>
            </li>
            <li class="reserve"><a href="<?php echo Yii::app()->request->baseUrl; ?>/Bus/Admin?mod=res" title=""><span>Reserve</span></a></li>
            <li class="histry">
                <a title="" class="exp" data-toggle="collapse" href="#history">
                    <span>History</span>
                </a>
                <ul id="history" class="sub collapse unstyled">
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/Bus/Admin?mod=oh" title="">History</a></li>
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/FileNo/OwnerHistory" title="">Owner History Under File No</a></li>
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/DailyBusQueue/Transaction" title="">Transaction</a></li>
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/CheckedCostConfiguration/Admin" title="">Receipts</a></li>
                </ul>
            </li>
            <li class="route">
                <a title="" class="exp" data-toggle="collapse" href="#busrm">
                    <span>Route Management</span>
                </a>
                <ul id="busrm" class="sub collapse unstyled">
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/Route/Create" title="">Create Route</a></li>
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/Route/Admin?mod=rtac" title="">Route Time & Cost</a></li>
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/Route/Admin?mod=bir" title="">Bus In Route</a></li>
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/Route/Admin?mod=bq" title="">Bus Queue Format</a></li>
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/Route/Admin?mod=dbq" title="">Daily Bus Queue</a></li>
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/Dailybusqueue/Admin" title="">View Queue For Payment</a></li>
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/Dailybusqueue/AllQueue" title="">View All Queue</a></li>
                </ul>
            </li>

            <li class="insurance">
                <a title="" class="" data-toggle="collapse" href="#insurance">
                    <span>Insurance</span><span class="numberLeft"><?php echo $total_expired_no;?></span>
                </a>
                <ul id="insurance" class="sub collapse unstyled">
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/Bus/Admin?mod=ins" title="">Bus Insurance</a></li>
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/Bus/Admin?mod=exp" title="">Expired Insurance<span class="numberLeft"><?php echo $total_expired_no;?></span></a></li>
                </ul>
            </li>
            <li class="viewlog"><a href="<?php echo Yii::app()->request->baseUrl; ?>/Activerecordlog/Admin" title=""><span>View Log</span></a></li>
                   <li class="message"><a href="<?php echo Yii::app()->request->baseUrl; ?>/Busownercontact/sms" title=""><span>SMS</span></a></li>

        </ul>
    </div>
    <!-- Content -->
    <div class="content">
        <?php echo $content; ?>
    </div>
    <div class="fix"></div>
</div>
<!-- Footer -->
<div id="footer">
    <div class="wrapper">
        <span>&copy; Copyright 2014. All rights reserved. System Designed & Developed by <a href="http://www.dynamicsoftech.com" title="Dynamic Softech Computer Solution">Dynamic Softech</a></span>
    </div>
</div>

</body>
</html>
<div style="display: none">
    <?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id'=>'mydialog',
// additional javascript options for the dialog plugin
        'options'=>array(
            'title'=>'<h1 style="text-align: center"><strong>Login Detail</strong></h1>',
            'autoOpen'=>false,
            'buttons' => array(
                array('text'=>'Close','click'=> 'js:function(){$(this).dialog("close");}'),
                array('text'=>'Cancel','click'=> 'js:function(){$(this).dialog("close");}'),
            ),
        ),
    ));
    ?>
    <form method="post" action="<?php echo Yii::app()->request->baseUrl; ?>/fileNo/CheckUser" id="login_form">
        <input type="text" value="<?php echo(Yii::app()->user->name);?>" name="username1" id="username" required="true" placeholder="User Name" style='text-align:center;' class="span3" readonly>
        <input type="password" name="password" required="true" id="password" placeholder="Password" style='text-align:center;' class="span3"><br/>
        <span id="msgbox" style="display:none"></span><br/>
        <input type="submit" value="Submit" id="submit" name="submit" class="btn btn-info">
    </form>
    <?php
    $this->endWidget('zii.widgets.jui.CJuiDialog');
    ?>
</div>
<script>
    function YNconfirm() {
        if (window.confirm('Do you really want to proceed?'))
        {
            $("#mydialog").dialog("open");
            document.getElementById("password").focus();
            return false;
        }
    }
</script>
<script language="javascript">
    $(document).ready(function()
    {
        $("#login_form").submit(function()
        {
            //remove all the class add the messagebox classes and start fading
            $("#msgbox").removeClass().addClass('messagebox').html('Validating....').fadeIn(1000);
            //check the username exists or not from ajax
            $.post("<?php echo Yii::app()->request->baseUrl; ?>/FileNo/CheckUser",{ username:$('#username').val(),password:$('#password').val(),rand:Math.random() } ,function(data)
            {
                if(data=='yes') //if correct login detail
                {
                    $("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
                    {
                        //add message and change the class of the box and start fading
                        $(this).html('<span style="color: green;">Redirecting.....</span>').addClass('messageboxok').fadeTo(900,1,
                            function()
                            {
                                //redirect to secure page
                                window.location='<?php echo Yii::app()->request->baseUrl; ?>/FileNo/Create';
                            });

                    });
                }
                else
                {
                    $("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
                    {
                        //add message and change the class of the box and start fading
                        $(this).html('<span style="color: red;">Your login detail is incorrect...</span>').addClass('messageboxerror').fadeTo(900,1);
                    });
                }

            });
            return false; //not to post the  form physically
        });
        //now call the ajax also focus move from
        $("#password").blur(function()
        {
            $("#login_form").trigger('submit');
        });
    });
</script>
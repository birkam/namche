<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <title>Project Namche - Dashboard For PRMBSS</title>
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/main1.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Cuprum' rel='stylesheet' type='text/css' />


    <!-- Design By Dynamic SofTech  --><!-- Bikram Neupane  --></head>

<body>


<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
    'Login',
);
?>
<?php
$this->beginWidget('zii.widgets.CPortlet', array(
    'title'=>"",
));

?>
<!--<h1>Login</h1>-->
<!---->
<!--<p>Please fill out the following form with your login credentials:</p>-->

<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'login-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>

    <!--    <p class="note">Fields with <span class="required">*</span> are required.</p>-->
    <div class="loginWrapper">
        <div class="loginLogo"><img src="images/NamcheLogoFinal.png" alt="" height="70px" width="70px" align="middle" style="margin-left: 55px"/></div>
        <div class="loginPanel">
            <div class="head"><h5 class="iUser">Login</h5></div>
            <form action="index.html" id="valid" class="mainForm">
                <fieldset>
                    <div class="loginRow noborder">
                        <label style="margin-left: 15px;">Username:</label>
                        <?php echo $form->textField($model,'username',array('id'=>'username','style' => 'height:30px;width:200px;font-size: 16px;margin-left:20px;')); ?>
                        <?php echo $form->error($model,'username',array('style' => 'color:red;margin-left:17px;')); ?>
                        <div class="fix"></div>
                    </div>

                    <div class="loginRow">
                        <label style="margin-left: 15px;">Password:</label>

                        <?php echo $form->passwordField($model,'password',  array('style' => 'height:30px;width:200px;font-size: 16px;margin-left:24px;')
                        ); ?>
                        <?php echo $form->error($model,'password',array('style' => 'color:red;margin-left:17px;')); ?>
                        <div class="fix"></div>
                        <!--                        <p class="hint">-->
                        <!--                            Hint: You may login with <kbd>demo</kbd>/<kbd>demo</kbd> or <kbd>admin</kbd>/<kbd>admin</kbd>.-->
                        <!--                        </p>-->
                    </div>

                    <div class="loginRow">
                        <div class="rememberMe">
                            <?php echo $form->checkBox($model,'rememberMe'); ?>
                            <?php echo $form->label($model,'rememberMe'); ?>
                            <?php echo $form->error($model,'rememberMe'); ?>
                            <?php echo CHtml::submitButton('Login', array('class'=>'greyishBtn submitForm')); ?>
                        </div>
                    </div>

                    <div class="row buttons">

                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    <?php $this->endWidget(); ?>
    <?php $this->endWidget(); ?>
</div><!-- form -->
<!-- Footer -->
<!--<div id="footer">-->
<!--    <div class="wrapper">-->
<!--        <span>&copy; Copyright 2014. All rights reserved. Admin theme by <a href="http://www.dynamicsoftech.com" title="Dynamic Softech Computer Solution">Dynamic Softech</a></span>-->
<!--    </div>-->
<!--</div>-->

</body>
</html>


<script type="text/javascript">
    window.onload = function() {
        document.getElementById("username").focus();
    };
</script>
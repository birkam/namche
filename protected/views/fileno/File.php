<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'mydialog',
// additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Dialog box 1',
        'autoOpen'=>false,
        'buttons' => array(
            array('text'=>'Close','click'=> 'js:function(){$(this).dialog("close");}'),
            array('text'=>'Cancel','click'=> 'js:function(){$(this).dialog("close");}'),
        ),
    ),
));
?>
<!--<form action="--><?php //echo Yii::app()->request->baseUrl; ?><!--/FileNo/CheckUser" method="POST" id="selectForm">-->
<form method="post" action="" id="login_form">
    <input type="text" value="<?php echo(Yii::app()->user->name);?>" name="username" id="username" required="true">
    <input type="password" name="password" required="true" id="password">
    <input type="submit" value="Submit" id="submit">
    <span id="msgbox" style="display:none"></span>
</form>
<?php
$this->endWidget('zii.widgets.jui.CJuiDialog');

// the button that may open the dialog
$this->widget('zii.widgets.jui.CJuiButton', array(
    'name'=>'btndialog',
    'caption'=>'Open Dialog',
    'onclick'=>new CJavaScriptExpression('function(){$("#mydialog").dialog("open"); return false;}'),
));

?>

<input type="submit" value="click" onclick="myfunc();" name = 'fhkasfhj'>
    <script>
        function myfunc() {
            $("#mydialog").dialog("open");
            return false;
        }
    </script>
<!--<script src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/js/jquery.js" type="text/javascript" language="javascript"></script>-->
<script language="javascript">
    //  Developed by Roshan Bhattarai
    //  Visit http://roshanbh.com.np for this script and more.
    //  This notice MUST stay intact for legal use

    $(document).ready(function()
    {
        $("#login_form").submit(function()
        {
            //remove all the class add the messagebox classes and start fading
            $("#msgbox").removeClass().addClass('messagebox').html('<span style="color:blue;">Validating....</span>').fadeIn(1000);
            //check the username exists or not from ajax
            $.post("<?php echo Yii::app()->request->baseUrl; ?>/FileNo/CheckUser",{ username:$('#username').val(),password:$('#password').val(),rand:Math.random() } ,function(data)
            {
                if(data=='yes') //if correct login detail
                {
                    $("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
                    {
                        //add message and change the class of the box and start fading
                        $(this).html('<span style="color:green;">Logging in.....</span>').addClass('messageboxok').fadeTo(900,1,
                            function()
                            {
                                //redirect to secure page
                                document.location='<?php echo Yii::app()->request->baseUrl; ?>/FileNo/Create';
                            });

                    });
                }
                else
                {
                    $("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
                    {
                        //add message and change the class of the box and start fading
                        $(this).html('<span style="color:red;">Your login detail is incorrect...</span>').addClass('messageboxerror').fadeTo(900,1);
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
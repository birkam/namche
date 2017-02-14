<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'checked-cost-configuration-form',
    'enableAjaxValidation'=>true,
)); ?>
<?php
$bus_id = $_GET['bus_id'];

$costConf = CostConfiguration::model()->findAll();

$file_assign_bus = FileAssignbus::model()->findAllByAttributes(array('bus_id'=>$bus_id, 'bus_status'=>1));
foreach($file_assign_bus as $f_a_b){
    $fileno_id = $f_a_b->fileno_id;
}
$owner_id_arr = array();
$file_no_owner = FilenoBus::model()->findAllByAttributes(array('fileno_id'=>$fileno_id, 'owner_status'=>1));
foreach($file_no_owner as $f_n_o){
    $owner_id = $f_n_o->owner_id;
    $owner_id_arr[$owner_id]=$owner_id;
}
$owner_id_str = implode(', ', $owner_id_arr);
$file_nos = FileNo::model()->findByPk($fileno_id);
$file_no = $file_nos->file_no;
echo 'File No = '.$file_no;
//echo '<br>Route = '.$routeCost;
$data = array();
$rateArr = array();
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<div style="display: none">
    <?php echo $form->textFieldRow($model,'file_no_id',array('class'=>'span5', 'value'=>$fileno_id)); ?>
    <?php echo $form->textFieldRow($model,'owners_id',array('class'=>'span5', 'value'=>$owner_id_str)); ?>
</div>

<br/>

<br/>

<div class="row">
    <div class="span3 banner banner1">
        <div id="0">
            <input type="checkbox" name="checkBoxListRoute" class="check" id="chb[]" value = '0'>Route Cost
            <input type="hidden" name="" class=""  id="tb0" value = '<?php echo $routeCost;?>'>
        </div>
    </div>
    <?php foreach($costConf as $cost){
        $data[$cost->id]=$cost->particular.', Rs.'.$cost->rate;
        $rateArr[$cost->id]=$cost->rate;
        ?>
        <div class="span3 banner banner1">
            <div id="<?php echo $cost->id?>">
                <input type="checkbox" name="checkBoxList[]" class="check"  id="chb[]" value = '<?php echo $cost->id?>'><?php echo $cost->particular;?>
                <input type="hidden" name="" class=""  id="tb<?php echo $cost->id;?>" value = '<?php echo $cost->rate?>'>
            </div>
        </div>

    <?php }?>
</div>
<h3>If others,</h3>
<div id="100">
    <input type="checkbox" name="check" class="check"  id="check" value = '1'>Others
</div>

<div id="other" style="display: none">
    <input type="text" name="particular" class="check"  id="particular" placeholder="Particular">
    <input type="text" name="amount" class="check"  id="amount" placeholder="Rate" pattern='[0-9.]+')>
</div>
<!--<span id="span"></span>-->
<!--Total: <span id="usertotal"> </span>-->
<input type="hidden" name="chbtotal" class="chbtotal"  id="chbtotal" placeholder="chbtotal">
<br/>
<input type="button" onclick="getGrandTotal()" value="Get Total"/>
<input type="text" name="grandtotal" class="grandtotal"  id="grandtotal" placeholder="Grand Total">
<br/>


<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'submit',
        'type'=>'primary',
        'label'=>$model->isNewRecord ? 'Create' : 'Save',
    )); ?>
</div>
<!--Nepali Date Picker: <input id="defaultPopup" size="10" name="datePick" class="">-->
<?php $this->endWidget(); ?>
<br/><br/>  <br/>
<!--<form id="date_convert" action="--><?php //echo Yii::app()->request->baseUrl; ?><!--/CheckedCostConfiguration/DateConvert" method="post">-->
<!--    <input id="defaultPopup" size="10" name="nepDate" class="" placeholder="Nepali Date">-->
<!---->
<!--    <span id="msgbox" style="display:none"></span><br/>-->
<!--    <input type="text" id="conResult">-->
<!--</form>-->
<script type="text/javascript">
    $(document).ready(function()
    {

//        $("#date_convert").submit(function()
        $('.tbody, .calendars-cmd-close').live("click", function()
        {
            //remove all the class add the messagebox classes and start fading
            $("#msgbox").removeClass().addClass('messagebox').html('Checking....').fadeIn(1000);
            //check the username exists or not from ajax
            <!--            $.post("--><?php //echo Yii::app()->request->baseUrl; ?><!--/CheckedCostConfiguration/DateConvert",{nyear:$('#nyear').val(),nmonth:$('#nmonth').val(),nday:$('#nday').val(),rand:Math.random()} ,function(data)-->
            $.post("<?php echo Yii::app()->request->baseUrl; ?>/CheckedCostConfiguration/DateConvert",{nepDate:$('#defaultPopup').val(),rand:Math.random()} ,function(data)
            {
                if(data=='no') //if correct login detail
                {
                    $("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
                    {
                        //add message and change the class of the box and start fading
                        $(this).html('<span style="color: red;">Detail no complete...</span>').addClass('messageboxerror').fadeTo(900,1);
                    });
                }
                else
                {
                    $("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
                    {
                        //add message and change the class of the box and start fading
                        $(this).html('<span style="color: green;">Converting......</span>').addClass('messageboxok').fadeTo(900,1,
                            function()
                            {
                                $('#conResult').val(data);
                                $('#msgbox').hide();
                            });

                    });
                }

            });
            return false; //not to post the  form physically
        });
        //now call the ajax also focus move from
        $("#nyear").blur(function()
        {
            $("#date_convert").trigger('submit');
        });
    });
</script>

<script>
    /*------------------------------Get CheckBox Total----------------------------------------------*/
    //    var $cbs = $('input[name="checkBoxList[]"]');
    var $cbs = $('input[id="chb[]"]');
    function calcUsage() {
        var total = 0;
        $cbs.each(function() {
            if (this.checked){
                var chkval = this.value;
                var textboxval =  $('#tb'+chkval).val();
                total = parseFloat(total) + parseFloat(textboxval);
            }
        });
        $("#chbtotal").val(total.toFixed(2));
//        $("#usertotal").text(total.toFixed(2));
    }
    $cbs.click(calcUsage);
    /*--------------------------Get CheckBox total + Other(grandTotal)--------------------------------------------------*/
    function getGrandTotal(){
        var chbtotal = $('#chbtotal').val();
        var otheramt = $('#amount').val();
        var grandtotal = +chbtotal + +otheramt;
        $("#grandtotal").val(grandtotal.toFixed(2));
    }
    /*----------------------------------------------------------------------------*/
    /*--------------------------Show Hide Othe Div--------------------------------------------------*/
    $(document).ready(function(){
        var $other = $('input[name="check"]');
        var $particular = $('#particular');
        var $amount = $('#amount');
        function chkOther(){
            $other.each(function() {
                if (this.checked){
                    $('#other').show();
                    $particular.attr('required',true);
                    $amount.attr('required',true);

                }
                else{
                    $('#other').hide();
                    $particular.attr('required',false);
                    $amount.attr('required',false);
                    $('#amount').attr("value", "");
                    $('#particular').attr("value", "");
                }
                var amt = $('#amount').val();

            });
        }
        $other.click(chkOther);
    });

    /*----------------------------------------------------------------------------*/
    /*-----------------------------Check At Least One CheckBox-----------------------------------------------*/
    $('#checked-cost-configuration-form').submit(function(){
        if(!$('#checked-cost-configuration-form input[type="checkbox"]').is(':checked')){
            alert("Please check at least one.");
            return false;
        }
    });
    /*----------------------------------------------------------------------------*/
</script>
<!--<script type="text/javascript">-->
<!--/*--------------------------Get Clock-------------------------------------------------*/-->
<!--    function updateTime() {-->
<!--        var currentTime = new Date();-->
<!--        var hours = currentTime.getHours();-->
<!--        var minutes = currentTime.getMinutes();-->
<!--        var seconds = currentTime.getSeconds();-->
<!--        if (minutes < 10){-->
<!--            minutes = "0" + minutes;-->
<!--        }-->
<!--        if (seconds < 10){-->
<!--            seconds = "0" + seconds;-->
<!--        }-->
<!--        var v = hours + ":" + minutes + ":" + seconds;-->
<!--        setTimeout("updateTime()",1000);-->
<!--        document.getElementById('tam').value=v;-->
<!--    }-->
<!--    updateTime();-->
<!--    //-->
<!--</script>-->
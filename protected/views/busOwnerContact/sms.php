<div class="title"><h5>Send SMS to <strong><?php $count = BusOwnerContact::Model()->count("busOwnerId"); echo $count ;?></strong> Owners </h5></div>
<br/>
<br/>
<form action="<?php echo Yii::app()->request->baseUrl;?>/BusOwnerContact/sms" id="sms" method="post" role="form">
    <textarea name="message" value="" id="editor1" name="editor1"  required="required" rows="10" cols="10000">
    </textarea>
    <p>Your Text Message contains  <strong> <span id="remaining"></span> </strong>characters.</p>
    <input type="submit" name="send" value="Send">
    <input type="submit" name="credit" value="Credit">
</form>
<?php
//$criteria = new CDbCriteria();
//$criteria->order = 'busOwnerId DESC';
//$mobile = BusOwnerContact::model()->findAll($criteria);
//foreach($mobile as $no){
//    $mobilenum = substr($no->mobile,0,10);
//echo $mobilenum.",";
//}
?>
<script>
    $('textarea').keyup(function() {
        var cs = $(this).val().length;
        $('#remaining').text(cs);
    });
</script>

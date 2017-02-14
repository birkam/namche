<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'bus-owner-emergency-contact-form',
    'enableAjaxValidation'=>true,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>
<?php $ownerId = $_GET['owner_id'];
$busOwner = BusOwner::model()->findByPk($ownerId);
?>
<div class="content">
    <div class="title"><h5>Register Bus</h5></div>
    <!-- USer Profile navigation -->
    <div class="leftNav">

        <ul class="sub">
            <!-- <li> -->
            <a href="#" title="">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/BusOwner/<?php echo $ownerId;?>/<?php echo $busOwner->photo;?>" width="208" height="200">
            </a>
            <!-- </li> -->
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/busOwner/<?php echo $ownerId;?>?ref=oi" title=""  class="active">Owner Information</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/busOwner/<?php echo $ownerId;?>?ref=ta" title="">Temporary Address</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/busOwner/<?php echo $ownerId;?>?ref=pa" title="">Permanent Address</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/busOwner/<?php echo $ownerId;?>?ref=a" title="">Attachments</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/busOwner/<?php echo $ownerId;?>?ref=ci" title="">Contact Information</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/busOwner/<?php echo $ownerId;?>?ref=eci" title="">Emergency Contact Information</a></li>
        </ul>

    </div>

    <fieldset>
        <div class="widget first">
            <div class="head"><h5 class="iList">Owner Contact</h5></div>
            <div class="rowElem ">
                <label>Name :</label>
                <div class="formRight">
                    <?php echo $form->textField($model,'name',array('class'=>'span5','maxlength'=>50)); ?>
                </div>
                <?php echo $form->error($model,'name'); ?>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>Relationship :</label>
                <div class="formRight">
                    <?php echo $form->textField($model,'relationship',array('class'=>'span5','maxlength'=>50)); ?>
                </div>
                <?php echo $form->error($model,'relationship'); ?>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>Mobile No. :</label>
                <div class="formRight">
                    <?php echo $form->textField($model,'mobile_no',array('class'=>'span5','maxlength'=>15)); ?>
                </div>
                <?php echo $form->error($model,'mobile_no'); ?>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>Landline :</label>
                <div class="formRight">
                    <?php echo $form->textField($model,'landline',array('class'=>'span5','maxlength'=>15)); ?>
                </div>
                <?php echo $form->error($model,'landline'); ?>
                <div class="fix"></div>
            </div>

            <div class="rowElem">
                <div class="form-actions">
                    <?php $this->widget('bootstrap.widgets.TbButton', array(
                        'buttonType'=>'submit',
                        'type'=>'primary',
                        'label'=>$model->isNewRecord ? 'Create' : 'Save',
                    )); ?>
                </div>
            </div>
            <div class="fix"></div>

        </div>
    </fieldset>
</div>
<?php $this->endWidget(); ?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'temp-address-form',
	'enableAjaxValidation'=>true,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php $ownerId = $_GET['owner_id'];
$busOwner = BusOwner::model()->findByPk($ownerId);
$tempAddress = TempAddress::model()->findByAttributes(array('busOwnerId'=>$ownerId));
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
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/busOwner/<?php echo $ownerId;?>?ref=oi" title="">Owner Information</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/busOwner/<?php echo $ownerId;?>?ref=ta" title="">Temporary Address</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/busOwner/<?php echo $ownerId;?>?ref=pa" title="">Permanent Address</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/busOwner/<?php echo $ownerId;?>?ref=a" title="">Attachments</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/busOwner/<?php echo $ownerId;?>?ref=ci" title="">Contact Information</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/busOwner/<?php echo $ownerId;?>?ref=eci" title="">Emergency Contact Information</a></li>
        </ul>

    </div>

    <fieldset>
        <div class="widget first">
            <div class="head"><h5 class="iList">Owner Temporary Address</h5></div>
            <div class="rowElem ">
                <label>Zone:</label>
                <div class="formRight">
                    <?php  echo $form->dropDownList($model,'zone',CHtml::listData(Zone::model()->findAll(
                            array('order' => 'zone_name')),'id','zone_name'),
                        array(
                            'prompt'=>'Select Zone',
                            'class'=>'span5',
                            'ajax' => array(
                                'type'=>'POST',
                                'url'=>Yii::app()->createUrl('BusOwner/LoadDistrict'),
                                'update'=>'#' . CHtml::activeId($model, 'district'),
                                'data'=>array('id'=>'js:this.value'),
                            )));
                    ?>
                </div>
                <?php echo $form->error($model,'zone'); ?>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>District :</label>
                <div class="formRight">
                    <?php  echo $form->dropDownList($model,'district',array(),array('class'=>'span5'));?>
                </div>
                <?php echo $form->error($model,'district'); ?>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>VDC/Municipality:</label>
                <div class="formRight">
                    <?php echo $form->textField($model,'vdc_municipality', array('class'=>'span5','maxlength'=>50)); ?>
                </div>
                <?php echo $form->error($model,'vdc_municipality'); ?>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>Ward:</label>
                <div class="formRight">
                    <?php echo $form->textField($model,'ward',array('class'=>'span5')); ?>
                </div>
                <?php echo $form->error($model,'ward'); ?>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>Tole:</label>
                <div class="formRight">
                    <?php echo $form->textField($model,'tole',array('class'=>'span5','maxlength'=>50)); ?>
                </div>
                <?php echo $form->error($model,'tole'); ?>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>House No:</label>
                <div class="formRight">
                    <?php echo $form->textField($model,'house_no',array('class'=>'span5','maxlength'=>20)); ?>
                </div>
                <?php echo $form->error($model,'house_no'); ?>
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

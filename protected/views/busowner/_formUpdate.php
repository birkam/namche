<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'bus-owner-form',
    'enableAjaxValidation'=>true,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data'
    ),
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<div class="content">
    <div class="title"><h5>Register Bus</h5></div>
    <!-- USer Profile navigation -->
    <div class="leftNav">

        <ul class="sub">
            <!-- <li> -->
            <a href="#" title="">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/BusOwner/<?php echo $model->id;?>/<?php echo $model->photo;?>" width="208" height="200">
            </a>
            <!-- </li> -->
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/busOwner/<?php echo $model->id;?>?ref=oi" title=""  class="active">Owner Information</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/busOwner/<?php echo $model->id;?>?ref=ta" title="">Temporary Address</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/busOwner/<?php echo $model->id;?>?ref=pa" title="">Permanent Address</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/busOwner/<?php echo $model->id;?>?ref=a" title="">Attachments</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/busOwner/<?php echo $model->id;?>?ref=ci" title="">Contact Information</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/busOwner/<?php echo $model->id;?>?ref=eci" title="">Emergency Contact Information</a></li>
        </ul>

    </div>

    <fieldset>
        <div class="widget first">
            <div class="head"><h5 class="iList">Owner Temporary Address</h5></div>
            <div class="rowElem ">
                <label><?php echo $form->labelEx($model,'fname')?> :</label>
                <div class="formRight">
                    <?php echo $form->textField($model,'fname',array('class'=>'span5','maxlength'=>50)); ?>
                </div>
                <?php echo $form->error($model,'fname'); ?>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label><?php echo $form->labelEx($model,'mname')?> :</label>
                <div class="formRight">
                    <?php echo $form->textField($model,'mname',array('class'=>'span5','maxlength'=>50)); ?>
                </div>
                <?php echo $form->error($model,'mname'); ?>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label><?php echo $form->labelEx($model,'lname')?> :</label>
                <div class="formRight">
                    <?php echo $form->textField($model,'lname',array('class'=>'span5','maxlength'=>50)); ?>
                </div>
                <?php echo $form->error($model,'lname'); ?>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label><?php echo $form->labelEx($model,'gender')?> :</label>
                <div class="formRight">
                    <?php echo $form->dropDownList($model,'gender',array('male'=>'Male', 'female'=>'Female', 'others'=>'Others'), array('class'=>'span5','maxlength'=>50)); ?>
                </div>
                <?php echo $form->error($model,'gender'); ?>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label><?php echo $form->labelEx($model,'marital_status')?> :</label>
                <div class="formRight">
                    <?php echo $form->dropDownList($model,'marital_status', array('single'=>'Single', 'married'=>'Married', 'divorced'=>'Divorced'), array('class'=>'span5','maxlength'=>50)); ?>
                </div>
                <?php echo $form->error($model,'marital_status'); ?>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label><?php echo $form->labelEx($model,'nationality')?> :</label>
                <div class="formRight">
                    <?php $this->widget('ext.CountrySelectorWidget', array(
                        'value' => $model->nationality,
                        'name' => Chtml::activeName($model, 'nationality'),
                        'id' => Chtml::activeId($model, 'nationality'),
                        'useCountryCode' => false,
                        'defaultValue' => 'Nepal',
                        'firstEmpty' => false,
                    ));?>
                </div>
                <?php echo $form->error($model,'nationality'); ?>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label><?php echo $form->labelEx($model,'date_of_birth')?> :</label>
                <div class="formRight">
                    <?php echo $form->textFieldRow($model,'date_of_birth',array('id'=>'dob', 'class'=>'span5','maxlength'=>30, 'placeholder')); ?>
                </div>
                <?php echo $form->error($model,'date_of_birth'); ?>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label><?php echo $form->labelEx($model,'id_no')?> :</label>
                <div class="formRight">
                    <?php echo $form->textField($model,'id_no',array('class'=>'span5','maxlength'=>30)); ?>
                </div>
                <?php echo $form->error($model,'id_no'); ?>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label><?php echo $form->labelEx($model,'photo')?> :</label>
                <div class="formRight">
                    <?php echo $form->fileField($model,'photo',array('class'=>'span5','maxlength'=>100)); ?>
                    <?php if($model->isNewRecord!='1'){ ?>
                        <?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/BusOwner/'. $model->id . '/' . $model->photo,"photo",array("width"=>200)); ?>
                    <?php } ?>
                </div>
                <?php echo $form->error($model,'photo'); ?>
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
<script>
    $('#dob').calendarsPicker({calendar: $.calendars.instance('nepali'), dateFormat: 'yyyy-mm-dd'});
</script>
<?php $id = $_GET['id'];
$user_details = UserDetails::model()->findByPk($id);
$email = $user_details->email;
$photo = $user_details->photo;
?>


    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
        'id'=>'user-account-form',
        'enableAjaxValidation'=>true,
        'enableClientValidation'=>true,
    )); ?>

    <!--<p class="help-block">Fields with <span class="required">*</span> are required.</p>-->


        <div class="title"><h5>Create User</h5></div>
        <!-- USer Profile navigation -->
        <div class="leftNav">

            <ul class="sub">
                <!-- <li> -->
                <a href="#" title="">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/UserPhoto/<?php echo $photo;?>" width="208" height="200">
                </a>
                <!-- </li> -->
                <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/UserDetails/View/<?php echo $id?>" title=""  class="active">Contact Details</a></li>
                <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/UserDetails/EmContact/<?php echo $id?>" title="">Emergency Contacts</a></li>
                <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/UserDetails/Qualification/<?php echo $id?>" title="">Qualifications</a></li>
                <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/UserDetails/Enrollment/<?php echo $id?>" title="">Enrollment</a></li>
            </ul>

        </div>
        <fieldset>
            <div class="widget first">
                <div class="head"><h5 class="iList">Contact Details</h5></div>
                <div class="rowElem ">
                    <?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>40, 'value'=>$email)); ?>

                    <?php echo $form->textFieldRow($model,'user_name',array('class'=>'span5','maxlength'=>30)); ?>

                    <?php echo $form->passwordFieldRow($model,'password',array('class'=>'span5','maxlength'=>100)); ?>

                    <?php echo $form->passwordFieldRow($model,'repeat_password',array('class'=>'span3','maxlength'=>100)); ?>

                    <?php echo $form->dropDownListRow($model,'role', array('1'=>'1', '2'=>'2', '3'=>'3'), array('prompt'=>'--Choose One--', 'class'=>'span5')); ?>

                    <?php echo $form->dropDownListRow($model,'status', array('1'=>'Active', '2'=>'Inactive'), array('prompt'=>'--Choose One--', 'class'=>'span5')); ?>
                </div>
            </div>
        </fieldset>

        <div class="form-actions">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'submit',
                'type'=>'primary',
                'label'=>$model->isNewRecord ? 'Submit Form' : 'Save',
            )); ?>
        </div>

        <?php $this->endWidget(); ?>
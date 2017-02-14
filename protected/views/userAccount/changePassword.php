<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/site/Index">Home</a> <span class="divider">/</span></li>
    <li class="active">Change Password</li>
</ul><hr />
<div class="form">
    <?php
    $this->widget('bootstrap.widgets.TbAlert', array(
        'fade' => true,
        'closeText' => '&times;', // false equals no close link
        'events' => array(),
        'htmlOptions' => array(),
        'userComponentId' => 'user',
        'alerts' => array( // configurations per alert type
            // success, info, warning, error or danger
            'success' => array('closeText' => '&times;'),
            'info', // you don't need to specify full config
            'warning' => array('closeText' => false),
            'error', //=> array('closeText' => 'AAARGHH!!')
        ),
    ));
    ?>

    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'chnage-password-form',
        'enableClientValidation' => true,
        'htmlOptions' => array('class' => 'well'),
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?>

    <div class="row">
        <?php echo $form->labelEx($model,'old_password'); ?>
        <?php echo $form->passwordField($model,'old_password'); ?>
        <?php echo $form->error($model,'old_password'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'new_password'); ?>
        <?php echo $form->passwordField($model,'new_password'); ?>
        <?php echo $form->error($model,'new_password'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'repeat_password'); ?>
        <?php echo $form->passwordField($model,'repeat_password'); ?>
        <?php echo $form->error($model,'repeat_password'); ?>
    </div>

    <div class="row buttons">
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'label' => 'Change Password')); ?>
    </div>
    <?php $this->endWidget(); ?>
</div>
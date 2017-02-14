<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/site/Home">Home</a> <span class="divider">/</span></li>
    <li class="active">Password Status</li>
</ul><hr />
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
        'error' //=> array('closeText' => 'AAARGHH!!')
    ),
));
?>
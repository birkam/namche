<?php
/**
 * Created by PhpStorm.
 * User: SANIL
 * Date: 2/23/15
 * Time: 4:13 PM
 */
$route_id = $_GET['id'];
//echo $route_id;
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
        'error' => array('closeText' => '')
    ),
));
?>

<p>The order of the Bus for queue.
</p>
<style type="text/css">
    #orderlist { list-style-type: none; margin: 3px 3px 20px 3px; padding: 2px; width: 60%; background-color:#FAF0B1;}
    #orderlist li { margin: 5px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
    #orderlist li span { position: absolute; margin-left: -1.3em; }
    #orderlist li img {float:right}
    .edit_add {background: url(images/edit_add.png) no-repeat;width:22px; height:22px;text-indent: -9999px; padding: 2px;}
</style>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'bus-inside-route-form',
        'enableAjaxValidation'=>true,
    )); ?>

    <?php
    $criteria = new CDbCriteria();
    $criteria->condition = 'route_id =:route_id AND bus_status =:bus_status';
    $criteria->order = 'queue ASC';
    $criteria->params = array(':route_id' => $route_id, ':bus_status'=>1);
    $items = array();
    $busInsideRoute = BusInsideRoute::model()->findAll($criteria);
    foreach($busInsideRoute as $bus){
        $busInfo = Bus::model()->findByPk($bus->bus_id);
        $items[$busInfo->id] = $busInfo->bus_no;
    }

//    $items = CHtml::listData($dataProvider->getData(), 'id', 'bus_id');

    $this->widget('zii.widgets.jui.CJuiSortable', array(
        'id'=>'orderlist',	// default is class="ui-sortable" id="yw0"
        'items' => $items,
        'itemTemplate'=>'<li id="{id}" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>{content}'.''.'</li>',
    ));
    ?>


    <div class="row buttons">
        <?php
        // Add a Submit button to send data to the controller
        echo CHtml::ajaxSubmitButton('Submit Changes',
            array('BusInsideRoute/orderAjax'),
            array(
                'type' => 'POST',
                'success'=>'js: function(data) {
							$("#display").append(data);
							alert(data);
							}',
                'beforeSend' => 'function(html) { alert("before send"); }',
                'data' => array(
                    // Turn the Javascript array into a PHP-friendly string
                    'Order' => 'js:$("ul#orderlist").sortable("toArray").toString()',
                )
            ));
        ?>
    </div>

    <?php $this->endWidget(); ?>
    <div id="display"></div>
</div><!-- form -->
<?php echo '<br/>starting with values: [SN] Bus No<br/> ';$sn = 1;
foreach($items as $i=>$item){ echo '['.$sn.'] '.$item.'<br/>'; $sn = $sn+1;}?>

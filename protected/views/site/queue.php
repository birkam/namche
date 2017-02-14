<?php
/**
 * Created by PhpStorm.
 * User: SANIL
 * Date: 2/23/15
 * Time: 12:27 PM
 */

$route_id = $_GET['id'];
$routeTime = RouteTime::model()->findAllByAttributes(array('route_id'=>$route_id,'status'=>1));
$route_time_no = count($routeTime);

$route_bus = BusInsideRoute::model()->findAllByAttributes(array('route_id'=>$route_id,'bus_status'=>1));
$route_bus_no = count($route_bus);


// Organize the dataProvider data into a Zii-friendly array
//$items = CHtml::listData($dataProvider->getData(), 'id', 'title');
$items = array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6');
// Implement the JUI Sortable plugin
$this->widget('zii.widgets.jui.CJuiSortable', array(
    'id' => 'orderList',
    'items' => $items,
));
// Add a Submit button to send data to the controller
echo CHtml::ajaxButton('Submit Changes', '', array(
    'type' => 'POST',
    'data' => array(
        // Turn the Javascript array into a PHP-friendly string
        'Order' => 'js:$("ul.ui-sortable").sortable("toArray").toString()',
    )
));
?>
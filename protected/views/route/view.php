<?php
$this->breadcrumbs=array(
    'Routes'=>array('index'),
    $model->id,
);

$this->menu=array(
    array('label'=>'List Route','url'=>array('index')),
    array('label'=>'Create Route','url'=>array('create')),
    array('label'=>'Update Route','url'=>array('update','id'=>$model->id)),
    array('label'=>'Delete Route','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('label'=>'Manage Route','url'=>array('admin')),
);
?>
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
        'error' => array('closeText' => '')
    ),
));
$cost = RouteCost::model()->findByAttributes(array('route_id'=>$model->id, 'cost_status'=>1));
?>
<h1>View Route Information</h1>
<table border="3px">
    <tr>
        <th>Route Name</th>
        <th>Distannce(Km.)</th>
    </tr>
    <tr>
        <td><h3><?php echo ucwords(($model->route_name));?></h3></td>
        <td><h3><?php echo $model->distance_km;?></h3></td>
    </tr>
</table>

<div class="widgets">
    <div class="left">
        <div class="widget">
            <div class="head"><h5>Route Time</h5></div>
            <div class="body">
                <form action="<?php echo Yii::app()->request->baseUrl; ?>/RouteTime/Create" method="POST">
                    <input type="hidden" value="<?php echo $model->id;?>" name="route_id">
                    <label>Route Time</label>
                    <?php $this->widget(
                        'bootstrap.widgets.TbTimePicker',
                        array(
                            'noAppend' => true, // mandatory
                            'options' => array(
                                'disableFocus' => true, // mandatory
                                'showMeridian' => false
                            ),
                            'name' => 'route_time',
                            'wrapperHtmlOptions' => array('class' => 'col-md-3'),
                        )
                    );
                    ?>
                    <label>Payment Type</label>
                    <?php echo CHtml::dropdownlist('payment_type', array(),array('1'=>'Single Queue','2'=>'Double Queue','3'=>'Triple Queue'),array('prompt'=>'Choose One', 'required'=>true));?>
                    <br/> <input type="submit" name="RouteTime" value="Submit" id="sub_time">
                </form>

            </div>
        </div>
    </div>
    <div class="right">
        <div class="widget">
            <div class="head"><h5>Recent Route Time</h5></div>
            <div class="body">
                <table>
                    <tr>
                        <th>Route Time</th>
                        <th>Payment Type</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <?php
                        $criteria = new CDbCriteria();
                        $criteria->condition = 'route_id = :route_id';
                        $criteria->order = 'status DESC, route_time ASC';
                        $criteria->params = array('route_id' => $model->id);
                        $routeTime = RouteTime::model()->findAll($criteria);
                        foreach($routeTime as $time){
                        if($time->payment_type == '1'){
                            $typo = 'Single Queue';
                        }elseif($time->payment_type == '2'){
                            $typo = 'Double Queue';
                        }elseif($time->payment_type == '3'){
                            $typo = 'Triple Queue';
                        }else{
                            $typo = '--';
                        }
                        ?>
                        <form action="<?php echo Yii::app()->request->baseUrl; ?>/Routetime/Deactivate" method="POST">
                            <td><?php echo $time->route_time; ?></td>
                            <td><?php echo $typo; ?></td>
                            <td><?php echo $time->status; ?></td>
                            <td><input type="hidden" value="<?php echo $model->id;?>" name="route_id">
                                <input type="hidden" value="<?php echo $time->id;?>" name="time_id">
                                <?php if($time->status == 1){?>
                                    <input type="submit" name="deactivate" value="Deactivate" id="deactivate">
                                <?php }?>
                            </td>
                        </form>
                    </tr>
                    <?php } ?>
                </table>

            </div>
        </div>
    </div>
    <div class="fix"></div>
</div>
<div class="widgets">
    <?php if(!empty($cost)){?>
        <div class="left">
            <div class="widget">
                <div class="head"><h5>Route Cost</h5><h5 class="pull right"><form action="<?php echo Yii::app()->request->baseUrl.'/routecost/update/'.$cost->id; ?>"><input type="submit" name="editCost" value="Update Cost"></form></h5></div>
                <div class="body">
                    <table>
                        <?php
                        /*$criteria = new CDbCriteria();
                        $criteria->condition = 'route_id = :route_id';
                        $criteria->order = 'id DESC';
                        $criteria->params = array('route_id' => $model->id);*/
                        ?>
                        <tr>
                            <th>Samiti Sulka</th><th>=</th>
                            <td>Rs.<?php echo $cost->samiti_sulka; ?></td>
                        </tr>
                        <tr>
                            <th>Bhalai Kosh</th><th>=</th>
                            <td>Rs.<?php echo $cost->bhalai_kosh; ?></td>

                        </tr>
                        <tr>
                            <th>Samrakshan</th><th>=</th>
                            <td>Rs.<?php echo $cost->samrakshan; ?></td>

                        </tr>
                        <tr>
                            <th>Ticket</th><th>=</th>
                            <td>Rs.<?php echo $cost->ticket; ?></td>

                        </tr>
                        <tr>
                            <th>Sahayog</th><th>=</th>
                            <td>Rs.<?php echo $cost->sahayog; ?></td>

                        </tr>
                        <tr>
                            <th>Bima</th><th>=</th>
                            <td>Rs.<?php echo $cost->bima; ?></td>

                        </tr>
                        <tr>
                            <th>Bibidh</th><th>=</th>
                            <td>Rs.<?php echo $cost->bibidh; ?></td>

                        </tr>
                        <tr>
                            <th>Mandir</th><th>=</th>
                            <td>Rs.<?php echo $cost->mandir; ?></td>

                        </tr>
                        <tr>
                            <th>Jokhim</th><th>=</th>
                            <td>Rs.<?php echo $cost->jokhim; ?></td>

                        </tr>
                        <tr>
                            <th>Anugaman</th><th>=</th>
                            <td>Rs.<?php echo $cost->anugaman; ?></td>

                        </tr>
                        <tr>
                            <th>Bi. Bya. Sulka</th><th>=</th>
                            <td>Rs.<?php echo $cost->bi_bya_sulka; ?></td>

                        </tr>
                        <tr>
                            <th>Ma. Ka. Kosh</th><th>=</th>
                            <td>Rs.<?php echo $cost->ma_kosh; ?></td>

                        </tr>

                        <tr>
                            <th>Total</th><th>=</th>
                            <td><hr/>Rs.<?php echo $cost->samiti_sulka+$cost->bhalai_kosh+$cost->samrakshan+$cost->ticket+$cost->sahayog+$cost->bima+$cost->bibidh+$cost->mandir+$cost->jokhim+$cost->anugaman+$cost->bi_bya_sulka+$cost->ma_kosh; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    <?php } if(empty($cost)){?>
        <div class="left">
            <div class="widget">
                <div class="head"><h5>Route Cost</h5></div>
                <div class="body">
                    <form action="<?php echo Yii::app()->request->baseUrl; ?>/RouteCost/Create" method="POST">
                        <input type="hidden" value="<?php echo $model->id;?>" name="route_id">
                        <table>
                            <tr>
                                <td><label>Samiti Sulka</label></td>
                                <td>=</td>
                                <td>
                                    <div class="input-prepend">
                                        <span class="add-on">Rs</span><input type="text" pattern="\d+(\.\d{2})?" name="samiti_sulka" id="samiti_sulka" required="true">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Bhalai Kosh</label></td>
                                <td>=</td>
                                <td>
                                    <div class="input-prepend">
                                        <span class="add-on">Rs</span><input type="text" pattern="\d+(\.\d{2})?" name="bhalai_kosh" id="bhalai_kosh" required="true">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Samrakshan</label></td>
                                <td>=</td>
                                <td>
                                    <div class="input-prepend">
                                        <span class="add-on">Rs</span><input type="text" pattern="\d+(\.\d{2})?" name="samrakshan" id="samrakshan" required="true">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Ticket</label></td>
                                <td>=</td>
                                <td>
                                    <div class="input-prepend">
                                        <span class="add-on">Rs</span><input type="text" pattern="\d+(\.\d{2})?" name="ticket" id="ticket" required="true">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Sahayog</label></td>
                                <td>=</td>
                                <td>
                                    <div class="input-prepend">
                                        <span class="add-on">Rs</span><input type="text" pattern="\d+(\.\d{2})?" name="sahayog" id="sahayog" required="true">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Bima</label></td>
                                <td>=</td>
                                <td>
                                    <div class="input-prepend">
                                        <span class="add-on">Rs</span><input type="text" pattern="\d+(\.\d{2})?" name="bima" id="bima" required="true">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Bibidh</label></td>
                                <td>=</td>
                                <td>
                                    <div class="input-prepend">
                                        <span class="add-on">Rs</span><input type="text" pattern="\d+(\.\d{2})?" name="bibidh" id="bibidh" required="true">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Mandir</label></td>
                                <td>=</td>
                                <td>
                                    <div class="input-prepend">
                                        <span class="add-on">Rs</span><input type="text" pattern="\d+(\.\d{2})?" name="mandir" id="mandir" required="true">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Jokhim</label></td>
                                <td>=</td>
                                <td>
                                    <div class="input-prepend">
                                        <span class="add-on">Rs</span><input type="text" pattern="\d+(\.\d{2})?" name="jokhim" id="jokhim" required="true">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Anugaman</label></td>
                                <td>=</td>
                                <td>
                                    <div class="input-prepend">
                                        <span class="add-on">Rs</span><input type="text" pattern="\d+(\.\d{2})?" name="anugaman" id="anugaman" required="true">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Bi. Bya. Sulka</label></td>
                                <td>=</td>
                                <td>
                                    <div class="input-prepend">
                                        <span class="add-on">Rs</span><input type="text" pattern="\d+(\.\d{2})?" name="bi_bya_sulka" id="bi_bya_sulka" required="true">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Ma. Ka. Kosh</label></td>
                                <td>=</td>
                                <td>
                                    <div class="input-prepend">
                                        <span class="add-on">Rs</span><input type="text" pattern="\d+(\.\d{2})?" name="ma_kosh" id="ma_kosh" required="true">
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <br/> <input type="submit" name="RouteCost" id="sub_samiti_sulka">
                    </form>
                </div>
            </div>
        </div>
        <div class="fix"></div>
    <?php } ?>
</div>
<?php ?>
<script>
    $("#sub_time").click(function(){
        var timeval = $('[name=route_time]').val();
        if(confirm('You are going to add time = "' + timeval +'"! Are you sure??')){
            return true;
//            $("#sub_time").attr("href", "query.php?ACTION=delete&ID='1'");
        }
        else{
            return false;
        }
    });
    $("#sub_samiti_sulka").click(function(){
        var recCost = $('[name=samiti_sulka]').val();
        if(confirm('You are going to insert queue cost factors! Are you sure??')){
            return true;
//            $("#sub_time").attr("href", "query.php?ACTION=delete&ID='1'");
        }
        else{
            return false;
        }
    });
</script>
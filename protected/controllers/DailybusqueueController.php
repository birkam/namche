<?php

class DailyBusQueueController extends RController
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/column1';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'rights', // perform access control for CRUD operations
        );
    }


    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $model=$this->loadModel($id);
        $bus_replace = BusInsideRoute::model()->with('bus')->findAllByAttributes(array('route_id'=>$model->route_id, 'bus_status'=>1));
        $this->render('dailyBusQueue',array(
            'model'=>$model,
            'bus_replace'=>$bus_replace,
        ));
    }
    public function actionView1($id)
    {
        $model=$this->loadModel($id);
        $bus_replace = BusInsideRoute::model()->with('bus')->findAllByAttributes(array('route_id'=>$model->route_id, 'bus_status'=>1));
        $bus_queued = DailyQueuedBus::model()->findAllByAttributes(array('daily_bus_queue_id'=>$model->id));
        $route_cost = RouteCost::model()->findByAttributes(array('route_id'=>$model->route_id, 'cost_status'=>1));
        $routeInfo = Route::model()->findByPk($model->route_id);

        $this->render('dailyBusQueue1',array(
            'model'=>$model,
            'bus_replace'=>$bus_replace,
            'bus_queued'=>$bus_queued,
            'route_cost'=>$route_cost,
            'route_info'=>$routeInfo,

        ));
    }
    public  function checkqueueserial($route_id){
        $criteria = new CDbCriteria;
        $criteria->condition = 'route_id=:route_id and bus_status=:bus_status';
        $criteria->params = array('route_id'=>$route_id, 'bus_status'=>1);
        $criteria->order = "queue asc";
        $busInsideRoute_cnt = BusInsideRoute::model()->findAll($criteria);
        if(!empty($busInsideRoute_cnt)){
            foreach($busInsideRoute_cnt as $key=>$val){
                if(($key)!=$val->queue){
                    $user = Yii::app()->getComponent('user');
                    $user->setFlash(
                        'info',
                        "It seems queue is broken. Please change queue and click <strong>SUBMIT CHANGES</strong> button"
                    );
                    $this->redirect(array('/BusInsideRoute/QueueChart/'.$route_id));
                }else {

                }
            }
        }else {
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }
    }

    public function checkroutevalid($routeTime, $routeCost, $route_id){
        if(empty($routeTime)){
            $user = Yii::app()->getComponent('user');
            $user->setFlash(
                'error',
                "<strong>No route time. Set the route time first. </strong>"
            );
            $this->redirect(array('Route/'.$route_id));
        }
        elseif(empty($routeCost)){
            $user = Yii::app()->getComponent('user');
            $user->setFlash(
                'error',
                "<strong>No route cost. Set the cost first. </strong>"
            );
            $this->redirect(array('Route/'.$route_id));
        }else{
            return true;
        }
    }
    public function actionCreate1($route_id){
        $model=new DailyBusQueue;
        $criteria = new CDbCriteria();
        $criteria->condition = 'route_id =:route_id AND status =:status';
        $criteria->order = 'route_time ASC';
        $criteria->params = array(':route_id' => $route_id, ':status'=>1);
        $routeTime = RouteTime::model()->findAll($criteria);
        $routeTime_no = count($routeTime);
        $routeCost = RouteCost::model()->findByAttributes(array('route_id'=>$route_id, 'cost_status'=>1));

        $valid = $this->checkroutevalid($routeTime, $routeCost, $route_id);
        if($valid==true){
            $this->performAjaxValidation($model);
            if(isset($_POST['DailyBusQueue']))
            {
                $model->attributes=$_POST['DailyBusQueue'];
                $checkSameDate = DailyBusQueue::model()->findByAttributes(array('route_id'=>$route_id, 'queue_date'=>$model->queue_date));
                if(!empty($checkSameDate)){
                    $user = Yii::app()->getComponent('user');
                    $user->setFlash(
                        'error',
                        "<strong>Queue Already Created For This Date ($model->queue_date). </strong>"
                    );
                    $this->redirect(array('DailyBusQueue/view1/'.$checkSameDate->id));
                    die();
                }
                /***/
                $criteria2 = new CDbCriteria();
                $criteria2->condition = 'route_id =:route_id';
                $criteria2->order = 'id DESC';
                $criteria2->limit = 1;
//                $criteria2->select = 'id';
                $criteria2->params = array(':route_id' => $route_id);
                $dailyBusQueue_last = DailyBusQueue::model()->find($criteria2);
                if(!empty($dailyBusQueue_last)){
                    $dailyBusQueue_id_last=$dailyBusQueue_last->id;
                }else{
                    $dailyBusQueue_id_last=0;
                }
                $queue = Yii::app()->db->createCommand('SELECT count(id) as total_bus_in_route, (SELECT queue FROM `tbl_bus_inside_route` where route_id='.$route_id.' and bus_status=1 order by queue desc limit 1) as lastqueue_serial_no FROM `tbl_bus_inside_route` where route_id='.$route_id.' and bus_status=1')->queryRow();
                if($queue['total_bus_in_route']>0) {
                    $this->checkqueueserial($route_id);
                    $queue_new=[];
                    if ($dailyBusQueue_id_last > 0) {
                        foreach ($routeTime as $rt) {
                            $dailyQueuedBus_last = DailyQueuedBus::model()->findByAttributes(['daily_bus_queue_id' => $dailyBusQueue_id_last, 'time_id'=>$rt->id]);
                            // foreach ($dailyQueuedBus_last as $dl) {
                            if(!empty($dailyQueuedBus_last)) {
                                $queue_serial_new = ($dailyQueuedBus_last->queue_serial + $routeTime_no);
                                if ($queue_serial_new > $queue['lastqueue_serial_no']) {
                                    $queue_serial_new = $queue_serial_new - $queue['total_bus_in_route'];
                                }
                                $busInsideRoute = BusInsideRoute::model()->findByAttributes(array('route_id' => $route_id, 'bus_status' => 1, 'queue' => $queue_serial_new));
                                $queue_new[] = ['time_id' => $rt->id, 'queue' => $queue_serial_new, 'bus_id' => $busInsideRoute->bus_id];
                            }else{
                                Yii::app()->user->setFlash('error', "Oops! Error In Time Queue Time Settings!!!");
                                $this->redirect(array('dailybusqueue/create1?route_id='.$route_id));
                                die();
                            }
                        }
                    } else {
                        $nextqueue = 0;
                        foreach ($routeTime as $rt){
                            $busInsideRoute = BusInsideRoute::model()->findByAttributes(array('route_id'=>$route_id, 'bus_status'=>1, 'queue'=>$nextqueue));
                            $queue_new[] = ['time_id' => $rt->id, 'queue' => $nextqueue, 'bus_id'=>$busInsideRoute->bus_id];
                            if($queue['lastqueue_serial_no'] > $nextqueue)
                                $nextqueue++;
                            else
                                $nextqueue = 0;
                        }
                    }
                }else{
                    Yii::app()->user->setFlash('error', "No Bus Found in Route!!!");
                    $this->redirect(array('dailybusqueue/create/'.$route_id));
                    die();
                }
                $model->route_id = $route_id;
                $model->created_date = date('Y-m-d H:i:s', time());
                $model->created_by = Yii::app()->user->user_ac_id;
                if($model->save()){
                    foreach ($queue_new as $qn) {
                        $m2 = new DailyQueuedBus();
                        $m2->daily_bus_queue_id=$model->id;
                        $m2->time_id=$qn["time_id"];
                        $m2->bus_id=$qn["bus_id"];
                        $m2->queue_serial=$qn["queue"];
                        $m2->payment_status=0;
                        $m2->bus_remove_type=0;
                        $m2->save();
                    }
                    $this->redirect(array('view1', 'id' => $model->id));
                }
            }
        }

        $this->render('create',array(
            'model'=>$model, 'route_id'=>$route_id,
        ));
    }
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new DailyBusQueue;
        $route_id = $_GET['id'];

        $criteria = new CDbCriteria();
        $criteria->condition = 'route_id =:route_id AND status =:status';
        $criteria->order = 'route_time ASC';
        $criteria->params = array(':route_id' => $route_id, ':status'=>1);
        $routeTime = RouteTime::model()->findAll($criteria);
        $routeTime_no = count($routeTime);

        $routeCost = RouteCost::model()->findByAttributes(array('route_id'=>$route_id, 'cost_status'=>1));

        if(empty($routeTime)){
            $user = Yii::app()->getComponent('user');
            $user->setFlash(
                'error',
                "<strong>No route time. Set the route time first. </strong>"
            );
            $this->redirect(array('Route/'.$route_id));
        }
        elseif(empty($routeCost)){
            $user = Yii::app()->getComponent('user');
            $user->setFlash(
                'error',
                "<strong>No route cost. Set the cost first. </strong>"
            );
            $this->redirect(array('Route/'.$route_id));
        }
        else{
// Uncomment the following line if AJAX validation is needed
            $this->performAjaxValidation($model);
            $some_arr = array();
            if(isset($_POST['DailyBusQueue']))
            {
                $model->attributes=$_POST['DailyBusQueue'];
                /***/
                $criteria2 = new CDbCriteria();
                $criteria2->condition = 'route_id =:route_id';
                $criteria2->order = 'id DESC';
                $criteria2->limit = 1;
                $criteria2->params = array(':route_id' => $route_id);
                $dailyBusQueue = DailyBusQueue::model()->findAll($criteria2);

                $criteria1 = new CDbCriteria();
                $criteria1->condition = 'route_id =:route_id AND bus_status =:bus_status';
                $criteria1->order = 'queue DESC';
                $criteria1->limit = 1;
                $criteria1->params = array(':route_id' => $route_id, ':bus_status'=>1);
                $busInsideRoute = BusInsideRoute::model()->find($criteria1);
                $lastBus = $busInsideRoute->queue;
                /*                foreach($busInsideRoute as $busInside){
                                    $lastBus = $busInside->queue;
                                }*/
                $busInsideRoute_cnt = BusInsideRoute::model()->countByAttributes(array('route_id'=>$route_id,'bus_status'=>1));
                $this->checkqueueserial($route_id);
                $queue = new SplQueue();
                if(empty($dailyBusQueue)){
                    $nextqueue = 0;

                    for($i = 0; $i <= ($routeTime_no-1); $i++){
                        $queue->push($nextqueue);
                        if($lastBus > $nextqueue){
                            $nextqueue = $nextqueue+1;
                        }else{
                            $nextqueue = 0;
                        }
                    }
                }elseif(!empty($dailyBusQueue)){
                    foreach($dailyBusQueue as $busQueue){
//                        $last_t_b_q = $busQueue->last_t_b_q;
                        $prevTimeId = $busQueue->time_id;
                        $prevTimeIdArr = explode(', ', $prevTimeId);
                        $prevTimeNo = count($prevTimeIdArr);
                        $last_queues = explode(', ',$busQueue->queue_serial);
                    }
                    if($prevTimeNo == $routeTime_no){
                        foreach($last_queues as $key=>$val){
                            if($val+$routeTime_no<=$lastBus){
                                $some_arr[]=$val+$routeTime_no;
                            }elseif($val+$routeTime_no>$lastBus){
                                $sum = $val+$routeTime_no;
                                $av = $sum-$lastBus-1;
                                if($av<=$lastBus){
                                    $some_arr[]=$av;
                                }else{
                                    $av = $av - $busInsideRoute_cnt;
                                    $some_arr[]=$av;
                                }
                            }
                        }
                    }else{
                        Yii::app()->user->setFlash('error', "Oops! Error In Time Queue Time Settings!!!");
                        $this->redirect(array('dailybusqueue/create/'.$route_id));
                        die();
                    }
                    $queue = array_slice($some_arr,0,$routeTime_no, true);
                }

                $busQueue_array = array();
                $bus_id_arr = array();
                foreach($queue as $q){
                    $busInsideRouteAll = BusInsideRoute::model()->findAllByAttributes(array('route_id'=>$route_id, 'bus_status'=>1, 'queue'=>$q));
                    foreach($busInsideRouteAll as $busIn){
                        $busId = $busIn->bus_id;
                        $bus_id_arr[] = $busId;
                    }
                    $busQueue_array[] = $q;
                }
                $routeTime_arr = array();
                foreach($routeTime as $time){
                    $time = $time->id;
                    $routeTime_arr[] = $time;
                }

                /***/
                $model->bus_id = implode(', ', $bus_id_arr);
                $model->time_id = implode(', ', $routeTime_arr);
                $model->queue_serial = implode(', ', $busQueue_array);
                $model->last_t_b_q = end($routeTime_arr).', '.end($bus_id_arr).', '.end($busQueue_array);   //last time_id, bus_id, queue_serial
                $model->created_date = date('Y-m-d H:i:s', time());
                $model->bus_status = 1;
                $model->route_id = $route_id;
                $model->created_by = Yii::app()->user->user_ac_id;
                $checkSameDate = DailyBusQueue::model()->findByAttributes(array('route_id'=>$route_id, 'queue_date'=>$model->queue_date));
                if(!empty($checkSameDate)){
                    $user = Yii::app()->getComponent('user');
                    $user->setFlash(
                        'error',
                        "<strong>Queue Already Created For This Date ($model->queue_date). </strong>"
                    );
                    $this->redirect(array('DailyBusQueue/'.$checkSameDate->id));
                }else{
                    if($model->save()){
                        $this->redirect(array('view','id'=>$model->id));
                    }
                }
            }
            $this->render('create',array(
                'model'=>$model, 'route_id'=>$route_id,
            ));
        }
    }

    public function actionBusRemove(){
        if(isset($_POST['remove'])){
            $rowId = $_POST['id'];    //pk of row
            $remove_bus_id = $_POST['bus_id'];   //bus id that must be removed.
            $remove_queue_serial = $_POST['queue_serial']; //bus serial that must be removed.

            $daily_bus_queue = DailyBusQueue::model()->findByPk($rowId);
//            $prev_queue_bus_id = $daily_bus_queue->bus_id;
            $prev_queue_serial = $daily_bus_queue->queue_serial;
            $prev_queue_serial_arr = explode(', ', $prev_queue_serial);
            $route_id = $daily_bus_queue->route_id;
            $queue_date = $daily_bus_queue->queue_date;
            $time_id = $daily_bus_queue->time_id;
            $time_id_arr = explode(',', $time_id);
            $routeTime_no = count($time_id_arr);
//            $prev_queue_bus_id_arr = explode(', ', $prev_queue_bus_id);
            $time_id_of_rep = $_POST['time_id'];
            $rep_position = array_search($time_id_of_rep,$time_id_arr);
            $criteria1 = new CDbCriteria();
            $criteria1->condition = 'route_id =:route_id AND bus_status =:bus_status';
            $criteria1->order = 'queue DESC';
            $criteria1->limit = 1;
            $criteria1->params = array(':route_id' => $route_id, ':bus_status'=>1);
            $busInsideRoute = BusInsideRoute::model()->findAll($criteria1);
            foreach($busInsideRoute as $busInside){
                $lastBus = $busInside->queue;
            }
            if($remove_queue_serial+$routeTime_no<=$lastBus){
                $newBus = $remove_queue_serial+$routeTime_no;
            }elseif($remove_queue_serial+$routeTime_no>$lastBus){
                $sum = $remove_queue_serial+$routeTime_no;
                $newBus=$sum-$lastBus-1;
            }
            $replacements = array($rep_position => $newBus);

            $serial_after_remove_array = array_replace($prev_queue_serial_arr, $replacements);

//            $bus_after_bus_remove_array = array_replace($prev_queue_bus_id_arr, $replacements);

            $final_bus_id_arr = array();
            foreach($serial_after_remove_array as $serial){
                $bus_inside_route_final = BusInsideRoute::model()->findByAttributes(array('queue'=>$serial, 'route_id'=>$route_id, 'bus_status'=>1));
                $final_bus_id_arr[]=$bus_inside_route_final->bus_id;
            }

            $model = new BusRemovedFrmQueue;
            if($daily_bus_queue->saveAttributes(array('bus_id'=> implode(', ', $final_bus_id_arr), 'queue_serial'=> implode(', ', $serial_after_remove_array)))==true){
                $model->route_id = $route_id;
                $model->bus_id = $remove_bus_id;
                $model->queue_date = $queue_date;
                $model->time_id = $time_id_of_rep;
                $model->created_by = Yii::app()->user->user_ac_id;
                $model->created_date = date('Y-m-d H:i:s', time());
                $model->save();
            }  //replaced with new bus and saved;
            $this->redirect(array('DailyBusQueue/'.$rowId));
        }
    }

    public function actionReplace(){
//        echo 1; exit;
        echo $this->renderPartial('replace');
    }

    public function actionTransaction(){
        $this->render('choosetype');
    }

    public function actionDailyAll(){
        if(isset($_POST['submit'])){
            $date = @$_POST['date'];
            if(!empty($date)){
//                $checkedCostConf = CheckedCostConfiguration::model()->findAllByAttributes(array('created_nep_date'=>$date));
                $sql = "SELECT ccc.id id, ccc.created_nep_date, ccc.bus_id bus_id, ccc.checked_id checked_id,ccc.checked_rate checked_rate, ccc.checked_others checked_others, ccc.receipt_no receipt_no, co.amount amount, ccc.created_by,
 crc.samiti_sulka crc_samiti_sulka, crc.bhalai_kosh crc_bhalai_kosh, crc.samrakshan crc_samrakshan, crc.ticket crc_ticket, crc.sahayog crc_sahayog, crc.bima crc_bima, crc.bibidh crc_bibidh, crc.mandir crc_mandir, crc.jokhim crc_jokhim, crc.anugaman crc_anugaman, crc.bi_bya_sulka crc_bi_bya_sulka, crc.ma_kosh crc_ma_kosh, crc.route_id route_id, crc.queue_time_id queue_time_id, crc.queue_date queue_date,
 res.samiti_sulka res_samiti_sulka, res.bhalai_kosh res_bhalai_kosh, res.samrakshan res_samrakshan, res.ticket res_ticket, res.sahayog res_sahayog, res.bima res_bima, res.bibidh res_bibidh, res.mandir res_mandir, res.jokhim res_jokhim, res.anugaman res_anugaman, res.bi_bya_sulka res_bi_bya_sulka, res.ma_kosh res_ma_kosh, res.reserve_date reserve_date, res.reserve_time reserve_time
FROM tbl_checked_cost_configuration ccc
LEFT JOIN tbl_checked_route_cost crc ON ccc.id = crc.checked_cost_conf_id
LEFT JOIN tbl_checked_others co ON ccc.id = co.checked_cost_conf_id
LEFT JOIN tbl_reserve res ON ccc.id = res.checked_cost_conf_id
WHERE ccc.created_nep_date='$date'";
                $command = Yii::app()->db->createCommand($sql);
                $checkedCostConf= $command->queryAll();
            }
        }else{
            $checkedCostConf=null;
        }
        $this->render('dailyall', array('checkedCostConf'=>$checkedCostConf));
    }

    public function actionDailyRoute(){
        if(isset($_POST['submit'])){
            $date = @$_POST['date'];
            if(!empty($date)){
                $sql = "SELECT ccc.id id, ccc.created_nep_date, ccc.bus_id bus_id, ccc.checked_others checked_others, ccc.receipt_no receipt_no,
 crc.samiti_sulka crc_samiti_sulka, crc.bhalai_kosh crc_bhalai_kosh, crc.samrakshan crc_samrakshan, crc.ticket crc_ticket, crc.sahayog crc_sahayog, crc.bima crc_bima, crc.bibidh crc_bibidh, crc.mandir crc_mandir, crc.jokhim crc_jokhim, crc.anugaman crc_anugaman, crc.bi_bya_sulka crc_bi_bya_sulka, crc.ma_kosh crc_ma_kosh, crc.route_id route_id, crc.queue_time_id queue_time_id, crc.queue_date queue_date,
 res.samiti_sulka res_samiti_sulka, res.bhalai_kosh res_bhalai_kosh, res.samrakshan res_samrakshan, res.ticket res_ticket, res.sahayog res_sahayog, res.bima res_bima, res.bibidh res_bibidh, res.mandir res_mandir, res.jokhim res_jokhim, res.anugaman res_anugaman, res.bi_bya_sulka res_bi_bya_sulka, res.ma_kosh res_ma_kosh, res.reserve_date reserve_date, res.reserve_time reserve_time
FROM tbl_checked_cost_configuration ccc
LEFT JOIN tbl_checked_route_cost crc ON ccc.id = crc.checked_cost_conf_id
LEFT JOIN tbl_reserve res ON ccc.id = res.checked_cost_conf_id
WHERE ccc.created_nep_date='$date'";
                $command = Yii::app()->db->createCommand($sql);
                $checkedCostConf= $command->queryAll();
            }
        }else{
            $checkedCostConf=null;
        }
        $this->render('dailyroute', array('checkedCostConf'=>$checkedCostConf));
    }

    public function actionAllQueue(){
        if(isset($_POST['submit'])){
            $date = @$_POST['date'];
            if(!empty($date)){
                $dailyBusQueue = DailyBusQueue::model()->findAllByAttributes(array('queue_date'=>$date));
            }
        }else{
            $dailyBusQueue=null;
        }
        $this->render('allqueue', array('dailyBusQueue'=>$dailyBusQueue));
    }
//    mansion print queue sheet
    public function actionAllQueuePrint($date){
        if(!empty($date)){
            $dailyBusQueue = DailyBusQueue::model()->findAllByAttributes(array('queue_date'=>$date));
//            $receipt = CheckedCostConfiguration::model()->findAllByAttributes(array('receipt_no'=>$receiptno));
        }
        $this->renderPartial('allqueueprint', array('dailyBusQueue'=>$dailyBusQueue));

    }
    public function actionMonthlyAll(){
        if(isset($_POST['date_only'])){
            $type='date_only';
            $month = @$_POST['year'].'-'.@$_POST['month'];
            $startDate=$month.'-01';
            $endDate=$month.'-32';
            if(!empty($month)){
                $sql = "SELECT ccc.created_nep_date, GROUP_CONCAT(ccc.checked_rate) checked_rate,
 GROUP_CONCAT(crc.samiti_sulka) crc_samiti_sulka, GROUP_CONCAT(crc.bhalai_kosh) crc_bhalai_kosh, GROUP_CONCAT(crc.samrakshan) crc_samrakshan, GROUP_CONCAT(crc.ticket) crc_ticket, GROUP_CONCAT(crc.sahayog) crc_sahayog, GROUP_CONCAT(crc.bima) crc_bima, GROUP_CONCAT(crc.bibidh) crc_bibidh, GROUP_CONCAT(crc.mandir) crc_mandir, GROUP_CONCAT(crc.jokhim) crc_jokhim, GROUP_CONCAT(crc.anugaman) crc_anugaman, GROUP_CONCAT(crc.bi_bya_sulka) crc_bi_bya_sulka, GROUP_CONCAT(crc.ma_kosh) crc_ma_kosh, GROUP_CONCAT(co.amount) amount,
 GROUP_CONCAT(res.samiti_sulka) res_samiti_sulka, GROUP_CONCAT(res.bhalai_kosh) res_bhalai_kosh, GROUP_CONCAT(res.samrakshan) res_samrakshan, GROUP_CONCAT(res.ticket) res_ticket, GROUP_CONCAT(res.sahayog) res_sahayog, GROUP_CONCAT(res.bima) res_bima, GROUP_CONCAT(res.bibidh) res_bibidh, GROUP_CONCAT(res.mandir) res_mandir, GROUP_CONCAT(res.jokhim) res_jokhim, GROUP_CONCAT(res.anugaman) res_anugaman, GROUP_CONCAT(res.bi_bya_sulka) res_bi_bya_sulka, GROUP_CONCAT(res.ma_kosh) res_ma_kosh, COUNT(1)
FROM tbl_checked_cost_configuration ccc
LEFT JOIN tbl_checked_route_cost crc ON ccc.id = crc.checked_cost_conf_id
LEFT JOIN tbl_checked_others co ON ccc.id = co.checked_cost_conf_id
LEFT JOIN tbl_reserve res ON ccc.id = res.checked_cost_conf_id
WHERE ccc.created_nep_date between '$startDate' and '$endDate'
GROUP BY ccc.created_nep_date";
                $command = Yii::app()->db->createCommand($sql);
                $checkedCostConf= $command->queryAll();
            }
        }elseif(isset($_POST['date_user'])){
            $type='date_user';
            $month = @$_POST['year'].'-'.@$_POST['month'];
            $startDate=$month.'-01';
            $endDate=$month.'-32';
            if(!empty($month)){
                $sql = "SELECT ccc.created_nep_date, ccc.created_by, GROUP_CONCAT(ccc.checked_rate) checked_rate,
 GROUP_CONCAT(crc.samiti_sulka) crc_samiti_sulka, GROUP_CONCAT(crc.bhalai_kosh) crc_bhalai_kosh, GROUP_CONCAT(crc.samrakshan) crc_samrakshan, GROUP_CONCAT(crc.ticket) crc_ticket, GROUP_CONCAT(crc.sahayog) crc_sahayog, GROUP_CONCAT(crc.bima) crc_bima, GROUP_CONCAT(crc.bibidh) crc_bibidh, GROUP_CONCAT(crc.mandir) crc_mandir, GROUP_CONCAT(crc.jokhim) crc_jokhim, GROUP_CONCAT(crc.anugaman) crc_anugaman, GROUP_CONCAT(crc.bi_bya_sulka) crc_bi_bya_sulka, GROUP_CONCAT(crc.ma_kosh) crc_ma_kosh, GROUP_CONCAT(co.amount) amount,
 GROUP_CONCAT(res.samiti_sulka) res_samiti_sulka, GROUP_CONCAT(res.bhalai_kosh) res_bhalai_kosh, GROUP_CONCAT(res.samrakshan) res_samrakshan, GROUP_CONCAT(res.ticket) res_ticket, GROUP_CONCAT(res.sahayog) res_sahayog, GROUP_CONCAT(res.bima) res_bima, GROUP_CONCAT(res.bibidh) res_bibidh, GROUP_CONCAT(res.mandir) res_mandir, GROUP_CONCAT(res.jokhim) res_jokhim, GROUP_CONCAT(res.anugaman) res_anugaman, GROUP_CONCAT(res.bi_bya_sulka) res_bi_bya_sulka, GROUP_CONCAT(res.ma_kosh) res_ma_kosh, COUNT(1)
FROM tbl_checked_cost_configuration ccc
LEFT JOIN tbl_checked_route_cost crc ON ccc.id = crc.checked_cost_conf_id
LEFT JOIN tbl_checked_others co ON ccc.id = co.checked_cost_conf_id
LEFT JOIN tbl_reserve res ON ccc.id = res.checked_cost_conf_id
WHERE ccc.created_nep_date between '$startDate' and '$endDate'
GROUP BY ccc.created_nep_date, ccc.created_by";
                $command = Yii::app()->db->createCommand($sql);
                $checkedCostConf= $command->queryAll();
            }
        }elseif(isset($_POST['user_only'])){
            $type='user_only';
            $month = @$_POST['year'].'-'.@$_POST['month'];
            $startDate=$month.'-01';
            $endDate=$month.'-32';
            if(!empty($month)){
                $sql = "SELECT ccc.created_nep_date, ccc.created_by, GROUP_CONCAT(ccc.checked_rate) checked_rate,
 GROUP_CONCAT(crc.samiti_sulka) crc_samiti_sulka, GROUP_CONCAT(crc.bhalai_kosh) crc_bhalai_kosh, GROUP_CONCAT(crc.samrakshan) crc_samrakshan, GROUP_CONCAT(crc.ticket) crc_ticket, GROUP_CONCAT(crc.sahayog) crc_sahayog, GROUP_CONCAT(crc.bima) crc_bima, GROUP_CONCAT(crc.bibidh) crc_bibidh, GROUP_CONCAT(crc.mandir) crc_mandir, GROUP_CONCAT(crc.jokhim) crc_jokhim, GROUP_CONCAT(crc.anugaman) crc_anugaman, GROUP_CONCAT(crc.bi_bya_sulka) crc_bi_bya_sulka, GROUP_CONCAT(crc.ma_kosh) crc_ma_kosh, GROUP_CONCAT(co.amount) amount,
 GROUP_CONCAT(res.samiti_sulka) res_samiti_sulka, GROUP_CONCAT(res.bhalai_kosh) res_bhalai_kosh, GROUP_CONCAT(res.samrakshan) res_samrakshan, GROUP_CONCAT(res.ticket) res_ticket, GROUP_CONCAT(res.sahayog) res_sahayog, GROUP_CONCAT(res.bima) res_bima, GROUP_CONCAT(res.bibidh) res_bibidh, GROUP_CONCAT(res.mandir) res_mandir, GROUP_CONCAT(res.jokhim) res_jokhim, GROUP_CONCAT(res.anugaman) res_anugaman, GROUP_CONCAT(res.bi_bya_sulka) res_bi_bya_sulka, GROUP_CONCAT(res.ma_kosh) res_ma_kosh, COUNT(1)
FROM tbl_checked_cost_configuration ccc
LEFT JOIN tbl_checked_route_cost crc ON ccc.id = crc.checked_cost_conf_id
LEFT JOIN tbl_checked_others co ON ccc.id = co.checked_cost_conf_id
LEFT JOIN tbl_reserve res ON ccc.id = res.checked_cost_conf_id
WHERE ccc.created_nep_date between '$startDate' and '$endDate'
GROUP BY ccc.created_by";
                $command = Yii::app()->db->createCommand($sql);
                $checkedCostConf= $command->queryAll();
            }
        }else{
            $checkedCostConf=null;
            $type=null;
        }
        $this->render('monthlyall', array('checkedCostConf'=>$checkedCostConf,'type'=>$type));
    }

    public function actionRange(){
        if(isset($_POST['date_only'])){
            $type='date_only';
            $dateRange = @$_POST['range'];
            $startDate = substr($dateRange, 0, 10);
            $endDate = substr($dateRange,13);

            if(!empty($dateRange)){
                $sql = "SELECT ccc.created_nep_date, GROUP_CONCAT(ccc.checked_rate) checked_rate,
 GROUP_CONCAT(crc.samiti_sulka) crc_samiti_sulka, GROUP_CONCAT(crc.bhalai_kosh) crc_bhalai_kosh, GROUP_CONCAT(crc.samrakshan) crc_samrakshan, GROUP_CONCAT(crc.ticket) crc_ticket, GROUP_CONCAT(crc.sahayog) crc_sahayog, GROUP_CONCAT(crc.bima) crc_bima, GROUP_CONCAT(crc.bibidh) crc_bibidh, GROUP_CONCAT(crc.mandir) crc_mandir, GROUP_CONCAT(crc.jokhim) crc_jokhim, GROUP_CONCAT(crc.anugaman) crc_anugaman, GROUP_CONCAT(crc.bi_bya_sulka) crc_bi_bya_sulka, GROUP_CONCAT(crc.ma_kosh) crc_ma_kosh, GROUP_CONCAT(co.amount) amount,
 GROUP_CONCAT(res.samiti_sulka) res_samiti_sulka, GROUP_CONCAT(res.bhalai_kosh) res_bhalai_kosh, GROUP_CONCAT(res.samrakshan) res_samrakshan, GROUP_CONCAT(res.ticket) res_ticket, GROUP_CONCAT(res.sahayog) res_sahayog, GROUP_CONCAT(res.bima) res_bima, GROUP_CONCAT(res.bibidh) res_bibidh, GROUP_CONCAT(res.mandir) res_mandir, GROUP_CONCAT(res.jokhim) res_jokhim, GROUP_CONCAT(res.anugaman) res_anugaman, GROUP_CONCAT(res.bi_bya_sulka) res_bi_bya_sulka, GROUP_CONCAT(res.ma_kosh) res_ma_kosh, COUNT(1)
FROM tbl_checked_cost_configuration ccc
LEFT JOIN tbl_checked_route_cost crc ON ccc.id = crc.checked_cost_conf_id
LEFT JOIN tbl_checked_others co ON ccc.id = co.checked_cost_conf_id
LEFT JOIN tbl_reserve res ON ccc.id = res.checked_cost_conf_id
WHERE ccc.created_nep_date between '$startDate' and '$endDate'
GROUP BY ccc.created_nep_date";
                $command = Yii::app()->db->createCommand($sql);
                $checkedCostConf= $command->queryAll();
            }
        }elseif(isset($_POST['date_user'])){
            $type='date_user';
            $dateRange = @$_POST['range'];
            $startDate = substr($dateRange, 0, 10);
            $endDate = substr($dateRange,13);
            if(!empty($dateRange)){
                $sql = "SELECT ccc.created_nep_date, ccc.created_by, GROUP_CONCAT(ccc.checked_rate) checked_rate,
 GROUP_CONCAT(crc.samiti_sulka) crc_samiti_sulka, GROUP_CONCAT(crc.bhalai_kosh) crc_bhalai_kosh, GROUP_CONCAT(crc.samrakshan) crc_samrakshan, GROUP_CONCAT(crc.ticket) crc_ticket, GROUP_CONCAT(crc.sahayog) crc_sahayog, GROUP_CONCAT(crc.bima) crc_bima, GROUP_CONCAT(crc.bibidh) crc_bibidh, GROUP_CONCAT(crc.mandir) crc_mandir, GROUP_CONCAT(crc.jokhim) crc_jokhim, GROUP_CONCAT(crc.anugaman) crc_anugaman, GROUP_CONCAT(crc.bi_bya_sulka) crc_bi_bya_sulka, GROUP_CONCAT(crc.ma_kosh) crc_ma_kosh, GROUP_CONCAT(co.amount) amount,
 GROUP_CONCAT(res.samiti_sulka) res_samiti_sulka, GROUP_CONCAT(res.bhalai_kosh) res_bhalai_kosh, GROUP_CONCAT(res.samrakshan) res_samrakshan, GROUP_CONCAT(res.ticket) res_ticket, GROUP_CONCAT(res.sahayog) res_sahayog, GROUP_CONCAT(res.bima) res_bima, GROUP_CONCAT(res.bibidh) res_bibidh, GROUP_CONCAT(res.mandir) res_mandir, GROUP_CONCAT(res.jokhim) res_jokhim, GROUP_CONCAT(res.anugaman) res_anugaman, GROUP_CONCAT(res.bi_bya_sulka) res_bi_bya_sulka, GROUP_CONCAT(res.ma_kosh) res_ma_kosh, COUNT(1)
FROM tbl_checked_cost_configuration ccc
LEFT JOIN tbl_checked_route_cost crc ON ccc.id = crc.checked_cost_conf_id
LEFT JOIN tbl_checked_others co ON ccc.id = co.checked_cost_conf_id
LEFT JOIN tbl_reserve res ON ccc.id = res.checked_cost_conf_id
WHERE ccc.created_nep_date between '$startDate' and '$endDate'
GROUP BY ccc.created_nep_date, ccc.created_by";
                $command = Yii::app()->db->createCommand($sql);
                $checkedCostConf= $command->queryAll();
            }
        }elseif(isset($_POST['user_only'])){
            $type='user_only';
            $dateRange = @$_POST['range'];
            $startDate = substr($dateRange, 0, 10);
            $endDate = substr($dateRange,13);
            if(!empty($dateRange)){
                $sql = "SELECT ccc.created_nep_date, ccc.created_by, GROUP_CONCAT(ccc.checked_rate) checked_rate,
 GROUP_CONCAT(crc.samiti_sulka) crc_samiti_sulka, GROUP_CONCAT(crc.bhalai_kosh) crc_bhalai_kosh, GROUP_CONCAT(crc.samrakshan) crc_samrakshan, GROUP_CONCAT(crc.ticket) crc_ticket, GROUP_CONCAT(crc.sahayog) crc_sahayog, GROUP_CONCAT(crc.bima) crc_bima, GROUP_CONCAT(crc.bibidh) crc_bibidh, GROUP_CONCAT(crc.mandir) crc_mandir, GROUP_CONCAT(crc.jokhim) crc_jokhim, GROUP_CONCAT(crc.anugaman) crc_anugaman, GROUP_CONCAT(crc.bi_bya_sulka) crc_bi_bya_sulka, GROUP_CONCAT(crc.ma_kosh) crc_ma_kosh, GROUP_CONCAT(co.amount) amount,
 GROUP_CONCAT(res.samiti_sulka) res_samiti_sulka, GROUP_CONCAT(res.bhalai_kosh) res_bhalai_kosh, GROUP_CONCAT(res.samrakshan) res_samrakshan, GROUP_CONCAT(res.ticket) res_ticket, GROUP_CONCAT(res.sahayog) res_sahayog, GROUP_CONCAT(res.bima) res_bima, GROUP_CONCAT(res.bibidh) res_bibidh, GROUP_CONCAT(res.mandir) res_mandir, GROUP_CONCAT(res.jokhim) res_jokhim, GROUP_CONCAT(res.anugaman) res_anugaman, GROUP_CONCAT(res.bi_bya_sulka) res_bi_bya_sulka, GROUP_CONCAT(res.ma_kosh) res_ma_kosh, COUNT(1)
FROM tbl_checked_cost_configuration ccc
LEFT JOIN tbl_checked_route_cost crc ON ccc.id = crc.checked_cost_conf_id
LEFT JOIN tbl_checked_others co ON ccc.id = co.checked_cost_conf_id
LEFT JOIN tbl_reserve res ON ccc.id = res.checked_cost_conf_id
WHERE ccc.created_nep_date between '$startDate' and '$endDate'
GROUP BY ccc.created_by";
                $command = Yii::app()->db->createCommand($sql);
                $checkedCostConf= $command->queryAll();
            }
        }else{
            $checkedCostConf=null;
            $type=null;
        }
        $this->render('range', array('checkedCostConf'=>$checkedCostConf,'type'=>$type));
    }
    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    /*    public function actionUpdate($id)
        {
            $model=$this->loadModel($id);

    // Uncomment the following line if AJAX validation is needed
    // $this->performAjaxValidation($model);

            if(isset($_POST['DailyBusQueue']))
            {
                $model->attributes=$_POST['DailyBusQueue'];
                if($model->save())
                    $this->redirect(array('view','id'=>$model->id));
            }

            $this->render('update',array(
                'model'=>$model,
            ));
        }*/

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    /*    public function actionDelete($id)
        {
            if(Yii::app()->request->isPostRequest)
            {
    // we only allow deletion via POST request
                $this->loadModel($id)->delete();

    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                if(!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
            else
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }*/

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('DailyBusQueue');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new DailyBusQueue('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['DailyBusQueue']))
            $model->attributes=$_GET['DailyBusQueue'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model=DailyBusQueue::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='daily-bus-queue-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}

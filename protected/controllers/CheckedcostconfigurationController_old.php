<?php

class CheckedcostconfigurationController extends RController
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
        if($model->checked_others==2){
            $this->redirect(array('reserve/'.$id));
        }else{
            $this->renderPartial('receipt',array(
                'model'=>$model,
            ));
        }
    }

    public function actionDateConvert(){
        $calendar = new Nepali_Calendar();
        $nepDate = @$_POST['nepDate'];
        if(!empty($nepDate)){
            list($nyear, $nmonth, $nday) =explode("-",$nepDate);

            $cal = $calendar->nep_to_eng($nyear, $nmonth, $nday);
            if(strlen($cal['date'])==2 && strlen($cal['month']) == 2){
                $english_date = $cal['year'] . '-' . $cal['month'] . '-' . $cal['date'];
            }elseif(strlen($cal['date'])==1 && strlen($cal['month']) == 2){
                $english_date = $cal['year'] . '-' . $cal['month'] . '-' .'0'. $cal['date'];
            }elseif(strlen($cal['date'])==2 && strlen($cal['month']) == 1){
                $english_date = $cal['year'] . '-' .'0'. $cal['month'] . '-' . $cal['date'];
            }elseif(strlen($cal['date'])==1 && strlen($cal['month']) == 1){
                $english_date = $cal['year'] . '-' .'0'. $cal['month'] . '-' .'0'. $cal['date'];
            }
            if(strlen($english_date) == 10){
                echo $english_date;
            }
        }else{
            echo 'no';
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    /*    public function actionFileNo(){
            $i = 1;
            while($i<=45){
                $file = new BusInsideRoute();
                $file->route_id = 1;
                $file->bus_id = $i;
                $file->queue = $i-1;
                $file->bus_status = 1;
                $file->created_by = 1;
                $file->created_date = date('Y-m-d H:i:s', time());
                $file->save();
                $i++;
            }
        }*/

    public function actionCreate()
    {
        $bus_id = $_GET['id'];
        $rid = @$_GET['rid'];
        $dbq_id = @$_GET['dbq_id'];
        $tid = @$_GET['tid'];
        require_once('/var/www/nepalidate/nepali_calendar.php');
        $calendar = new Nepali_Calendar();
        $engDate = date('Y-m-d', time());
        if(!empty($engDate)){
            list($eDate, $emonth, $eday) =explode("-",$engDate);

            $cal = $calendar->eng_to_nep($eDate, $emonth, $eday);
            if(strlen($cal['date'])==2 && strlen($cal['month']) == 2){
                $nepali_date = $cal['year'] . '-' . $cal['month'] . '-' . $cal['date'];
            }elseif(strlen($cal['date'])==1 && strlen($cal['month']) == 2){
                $nepali_date = $cal['year'] . '-' . $cal['month'] . '-' .'0'. $cal['date'];
            }elseif(strlen($cal['date'])==2 && strlen($cal['month']) == 1){
                $nepali_date = $cal['year'] . '-' .'0'. $cal['month'] . '-' . $cal['date'];
            }elseif(strlen($cal['date'])==1 && strlen($cal['month']) == 1){
                $nepali_date = $cal['year'] . '-' .'0'. $cal['month'] . '-' .'0'. $cal['date'];
            }
        }
        if(($rid != null) and ($dbq_id != null)){
            $time  = RouteTime::model()->findByPk($tid);
            $pt=$time->payment_type;
            $routeCostDetails = RouteCost::model()->findByAttributes(array('route_id'=>$rid, 'cost_status'=>1));
            $routeCost = $pt*($routeCostDetails->samiti_sulka+$routeCostDetails->bhalai_kosh+$routeCostDetails->samrakshan+$routeCostDetails->ticket+$routeCostDetails->sahayog+$routeCostDetails->bima+$routeCostDetails->bibidh+$routeCostDetails->mandir+$routeCostDetails->jokhim+$routeCostDetails->anugaman+$routeCostDetails->bi_bya_sulka+$routeCostDetails->ma_kosh);
            $route_cost_str = $pt*$routeCostDetails->samiti_sulka.','.$pt*$routeCostDetails->bhalai_kosh.','.$pt*$routeCostDetails->samrakshan.','.$pt*$routeCostDetails->ticket.','.$pt*$routeCostDetails->sahayog.','.$pt*$routeCostDetails->bima.','.$pt*$routeCostDetails->bibidh.','.$pt*$routeCostDetails->mandir.','.$pt*$routeCostDetails->jokhim.','.$pt*$routeCostDetails->anugaman.','.$routeCostDetails->bi_bya_sulka.','.$pt*$routeCostDetails->ma_kosh;
        }
        $file_assign_bus = FileAssignbus::model()->findAllByAttributes(array('bus_id'=>$bus_id, 'bus_status'=>1));
        if(empty($file_assign_bus)){
            $user = Yii::app()->getComponent('user');
            $user->setFlash(
                'error',
                "<strong>This Bus Has No File No.</strong>"
            );
            $this->redirect(Yii::app()->request->baseUrl.'/FileNo/Admin?mod=btf');
        }
        if(!empty($file_assign_bus)){
            foreach($file_assign_bus as $f_a_b){
                $fileno_id = $f_a_b->fileno_id;
            }
        }
        $file_no_owner = FilenoBus::model()->findAllByAttributes(array('fileno_id'=>$fileno_id, 'owner_status'=>1));
        if(empty($file_no_owner)){
            $user = Yii::app()->getComponent('user');
            $user->setFlash(
                'error',
                "<strong>This Bus Has No Active Owners.</strong>"
            );
            $this->redirect(Yii::app()->request->baseUrl.'/FilenoBus/Create/'.$fileno_id);
        }
        $model=new CheckedCostConfiguration;
        $other = new CheckedOthers();
        $route_cost = new CheckedRouteCost();
// Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if(isset($_POST['CheckedCostConfiguration']))
        {
            $model->attributes=$_POST['CheckedCostConfiguration'];

            if(!empty($_POST['checkBoxList'])){
                $checkedList = $_POST['checkBoxList'];
                $costArr = array();
                foreach($checkedList as $key=>$val){
                    $cost = CostConfiguration::model()->findByPk($val);
                    $costArr[$cost->rate] = $cost->rate;
                }
                $costListStr = implode(', ', $costArr);
                $checkedListStr = implode(', ', $checkedList);
                $model->checked_rate = $costListStr;
                $model->checked_id = $checkedListStr;
            }
            $checkBoxListRoute = @$_POST['checkBoxListRoute'];
            $checkedOther = @$_POST['check'];

            $bus_and_driver = BusAndDriver::model()->findByAttributes(array('bus_id'=>$bus_id, 'driver_status'=>1));
            if(!empty($bus_and_driver)){
                $model->driver_id = $bus_and_driver->driver_id;
            }else{
                $model->driver_id = null;
            }
            $last = Yii::app()->db->createCommand()->select('max(receipt_no) as max')->from('tbl_checked_cost_configuration')->queryScalar();
            if(empty($last)){
                $last_receipt_no = 1;
            }else{
                $last_receipt_no = $last+1;
            }			
            $model->bus_id = $bus_id;
            $model->checked_others = $checkedOther;
            $model->created_date = date('Y-m-d H:i:s', time());
            $model->created_by = Yii::app()->user->user_ac_id;
            $model->created_nep_date = $nepali_date;
            if(!empty($rid) and !empty($dbq_id)){
                $dailyBusQueue = DailyBusQueue::model()->findByPk($dbq_id);
//                $bus_id_ = arr = explode(', ', $dailyBusQueue->bus_id);
//                $key_of_bus = array_search($bus_id, $bus_id_arr); //finding key of selected bus from bus_id string
//                $time_id_arr = explode(', ', $dailyBusQueue->time_id);
//                $time_id = $time_id_arr[$key_of_bus];             //finding time_id of selected bus. (logic = find bus_id position and using that position find time value)
                $queue_date = $dailyBusQueue->queue_date;
                if(empty($dailyBusQueue->payment_status)){
                    $new_pay_sts = $bus_id;
                }else{
                    $new_pay_sts = $dailyBusQueue->payment_status.', '.$bus_id;
                }
            }

            if($model->save()){
                if(!empty($checkedOther)){
                    $other->bus_id = $bus_id;
                    $other->checked_cost_conf_id = $model->id;
                    $other->particular = $_POST['particular'];
                    $other->amount = $_POST['amount'];
                    $other->created_date = date('Y-m-d H:i:s', time());
                    $other->created_nep_date = $nepali_date;
                    $other->created_by = Yii::app()->user->user_ac_id;
                    $other->save();
                }
                if($checkBoxListRoute == '0'){ //queue_date, queue_time_id
                    $route_cost->bus_id = $bus_id;
                    $route_cost->checked_cost_conf_id = $model->id;
                    $route_cost->route_id = $rid;
                    $route_cost->route_cost = $route_cost_str;
                    $route_cost->queue_date = $queue_date;
                    $route_cost->queue_time_id = $tid;
                    $route_cost->payment_type = $pt;
                    $route_cost->created_nep_date = $nepali_date;
                    if($route_cost->save()){
                        $dailyBusQueue->saveAttributes(array('payment_status'=>$new_pay_sts));
                    }
                }
                $this->redirect(array('view','id'=>$model->id));
            }
        }
        if(($rid != null) and ($dbq_id != null)){
            $this->render('create',array('model'=>$model, 'other'=>$other, 'rid'=>$rid, 'dbq_id'=>$dbq_id, 'routeCost'=>$routeCost, 'pt'=>$pt));
        }else{
            $this->render('create',array('model'=>$model, 'other'=>$other, 'rid'=>$rid, 'dbq_id'=>$dbq_id));
        }
    }
    /*    public function actionCreate()
        {
            $bus_id = $_GET['bus_id'];

            $file_assign_bus = FileAssignbus::model()->findAllByAttributes(array('bus_id'=>$bus_id, 'bus_status'=>1));
            if(empty($file_assign_bus)){
                $user = Yii::app()->getComponent('user');
                $user->setFlash(
                    'error',
                    "<strong>This Bus Has No File No.</strong>"
                );
                $this->redirect(Yii::app()->request->baseUrl.'/FileNo/Admin?mod=btf');
            }
            if(!empty($file_assign_bus)){
                foreach($file_assign_bus as $f_a_b){
                    $fileno_id = $f_a_b->fileno_id;
                }
            }
            $file_no_owner = FilenoBus::model()->findAllByAttributes(array('fileno_id'=>$fileno_id, 'owner_status'=>1));
            if(empty($file_no_owner)){
                $user = Yii::app()->getComponent('user');
                $user->setFlash(
                    'error',
                    "<strong>This Bus Has No Active Owners.</strong>"
                );
                $this->redirect(Yii::app()->request->baseUrl.'/FilenoBus/Create/'.$fileno_id);
            }
            $model=new CheckedCostConfiguration;
            $other = new CheckedOthers();
            $route_cost = new CheckedRouteCost();
    // Uncomment the following line if AJAX validation is needed
            $this->performAjaxValidation($model);

            if(isset($_POST['CheckedCostConfiguration']))
            {
                $model->attributes=$_POST['CheckedCostConfiguration'];
                date_default_timezone_set('Asia/Kathmandu');
                if(!empty($_POST['checkBoxList'])){
                    $checkedList = $_POST['checkBoxList'];
                    $costArr = array();
                    foreach($checkedList as $key=>$val){
                        $cost = CostConfiguration::model()->findByPk($val);
                        $costArr[$cost->rate] = $cost->rate;
                    }
                    $costListStr = implode(', ', $costArr);
                    $checkedListStr = implode(', ', $checkedList);
                    $model->checked_rate = $costListStr;
                    $model->checked_id = $checkedListStr;
                }
                $checkBoxListRoute = @$_POST['checkBoxListRoute'];
                $checkedOther = @$_POST['check'];

                $bus_and_driver = BusAndDriver::model()->findByAttributes(array('bus_id'=>$bus_id, 'driver_status'=>1));
                $model->driver_id = $bus_and_driver->driver_id;
                $model->bus_id = $bus_id;
                $model->checked_others = $checkedOther;
                $model->created_date = date('Y-m-d H:i:s', time());
                $model->created_by = Yii::app()->user->user_ac_id;
                if(!empty(@$_GET['rid']) and (@$_GET['dbq_id']) and (Yii::app()->session['route_cost'])){
                    $dailyBusQueue = DailyBusQueue::model()->findByPk(@$_GET['dbq_id']);
                    $key_of_bus = array_search($bus_id, explode(', ', $dailyBusQueue->bus_id)); //finding key of selected bus from bus_id string
                    $time_id = explode(', ', $dailyBusQueue->time_id)[$key_of_bus];             //finding time_id of selected bus. (logic = find bus_id position and using that position find time value)
                    $queue_date = $dailyBusQueue->queue_date;
                    if(empty($dailyBusQueue->payment_status)){
                        $new_pay_sts = $bus_id;
                    }else{
                        $new_pay_sts = $dailyBusQueue->payment_status.', '.$bus_id;
                    }
                }
                if($model->save()){
                    if($checkBoxListRoute == 0 and (!empty(@$_GET['rid']) and (@$_GET['dbq_id']) and (Yii::app()->session['route_cost']))){ //queue_date, queue_time_id
                        $route_cost->bus_id = $bus_id;
                        $route_cost->checked_cost_conf_id = $model->id;
                        $route_cost->route_id = @$_GET['rid'];
                        $route_cost->route_cost = Yii::app()->session['route_cost'];
                        $route_cost->queue_date = $queue_date;
                        $route_cost->queue_time_id = $time_id;
                        if($route_cost->save()){
                            $dailyBusQueue->saveAttributes(array('payment_status'=>$new_pay_sts));
    //                        unset(Yii::app()->session['rid']);
                            unset(Yii::app()->session['route_cost']);
    //                        unset(Yii::app()->session['dbq_id']);
                        }
                    }
                    if(!empty($checkedOther)){
                        $other->bus_id = $bus_id;
                        $other->checked_cost_conf_id = $model->id;
                        $other->particular = $_POST['particular'];
                        $other->amount = $_POST['amount'];
                        $other->created_date = date('Y-m-d H:i:s', time());
                        $other->created_by = Yii::app()->user->user_ac_id;
                        $other->save();
                    }
                    $this->redirect(array('view','id'=>$model->id));
                }
            }

            $this->render('create',array(
                'model'=>$model, 'other'=>$other,
            ));
        }
    */


    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('CheckedCostConfiguration');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new CheckedCostConfiguration('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['CheckedCostConfiguration']))
            $model->attributes=$_GET['CheckedCostConfiguration'];

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
        $model=CheckedCostConfiguration::model()->findByPk($id);
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
        if(isset($_POST['ajax']) && $_POST['ajax']==='checked-cost-configuration-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}

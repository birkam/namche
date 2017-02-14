<?php

class ReserveController extends RController
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'rights', // perform access control for CRUD operations
//            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $model=CheckedCostConfiguration::model()->findByPk($id);
        if($model->checked_others==2){
            $this->render('receipt1',array(
                'model'=>$model,
            ));
        }else{
            $this->redirect(array('checkedcostconfiguration/'.$id));
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($id)
    {
        $costconf=new CheckedCostConfiguration;
        $bus=Bus::model()->findByPk($id);
        $model=new Reserve;
        $bus_id = $id;
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
        $file_assign_bus = FileAssignbus::model()->findAllByAttributes(array('bus_id'=>$bus_id, 'bus_status'=>1));
        if(empty($file_assign_bus)){
            $user = Yii::app()->getComponent('user');
            $user->setFlash(
                'error',
                "<strong>This Bus Has No File No.</strong>"
            );
            $this->redirect(Yii::app()->request->baseUrl.'/FileNo/Admin?mod=btf');
        }else{
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
        }else{
            $owner_id_arr = array();
            foreach($file_no_owner as $f_n_o){
                $owner_id = $f_n_o->owner_id;
                $owner_id_arr[$owner_id]=$owner_id;
            }
            $owner_id_str = implode(', ', $owner_id_arr);
        }
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Reserve']))
        {
            $model->attributes=$_POST['Reserve'];
            $last = Yii::app()->db->createCommand()->select('max(receipt_no) as max')->from('tbl_checked_cost_configuration')->queryScalar();
            if(empty($last)){
                $last_receipt_no = 1;
            }else{
                $last_receipt_no = $last+1;
            }
            $costconf->receipt_no = str_pad($last_receipt_no, 10, "0", STR_PAD_LEFT);
            $costconf->bus_id=$bus_id;
            $costconf->checked_others='2';       //2 for reserve
            $costconf->file_no_id=$fileno_id;
            $costconf->owners_id=$owner_id_str;
            $bus_and_driver = BusAndDriver::model()->findByAttributes(array('bus_id'=>$bus_id, 'driver_status'=>1));
            if(!empty($bus_and_driver)){
                $costconf->driver_id = $bus_and_driver->driver_id;
            }else{
                $costconf->driver_id = null;
            }
            $costconf->created_by=Yii::app()->user->user_ac_id;
            $costconf->created_date=date('Y-m-d H:i:s');
            $costconf->created_nep_date=$nepali_date;
            if($model->validate()) {
                $model->bus_id=$bus_id;
                $model->created_by=Yii::app()->user->user_ac_id;
                $model->created_date=date('Y-m-d H:i:s');
                if ($costconf->save()) {
                    $model->checked_cost_conf_id=$costconf->id;
                    $model->save();
                    $this->redirect(array('view', 'id' => $costconf->id));
                }
            }
        }

        $this->render('create',array(
            'model'=>$model,'bus'=>$bus,'owner_id_arr'=>$owner_id_arr,'fileno_id'=>$fileno_id
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Reserve']))
        {
            $model->attributes=$_POST['Reserve'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('Reserve');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new Reserve('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Reserve']))
            $model->attributes=$_GET['Reserve'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Reserve the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=Reserve::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Reserve $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='reserve-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}

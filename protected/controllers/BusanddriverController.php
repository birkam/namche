<?php

class BusAndDriverController extends RController
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
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
//    public function accessRules()
//    {
//        return array(
//            array('allow',  // allow all users to perform 'index' and 'view' actions
//                'actions'=>array('index','view'),
//                'users'=>array('*'),
//            ),
//            array('allow', // allow authenticated user to perform 'create' and 'update' actions
//                'actions'=>array('create','update'),
//                'users'=>array('@'),
//            ),
//            array('allow', // allow admin user to perform 'admin' and 'delete' actions
//                'actions'=>array('admin','delete'),
//                'users'=>array('admin'),
//            ),
//            array('deny',  // deny all users
//                'users'=>array('*'),
//            ),
//        );
//    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $bus_id = $_GET['id'];
        if(@$_GET['rid'] !== null and @$_GET['dbq_id'] !== null){
            $rid = $_GET['rid'];
            $dbq_id = $_GET['dbq_id'];
        }
        else{
            $user = Yii::app()->getComponent('user');
            $user->setFlash(
                'error',
                "<strong>Oops!!! Something went wrong.</strong>"
            );
            $this->redirect(array('DailyBusQueue/'.$_GET['dbq_id']));
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


        $model=new BusAndDriver;

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if(isset($_POST['BusAndDriver']))
        {
            $model->attributes=$_POST['BusAndDriver'];
            $model->bus_id = $bus_id;
            $model->driver_status = 1;
            $model->created_date = date('Y-m-d H:i:s', time());
            $model->created_by = Yii::app()->user->user_ac_id;
            $last_bus_driver_id = Yii::app()->db->createCommand()->select('max(id) as max')->from('tbl_bus_and_driver')->where('bus_id ='.$bus_id)->queryScalar();

            if($model->save()){
                if(!empty($last_bus_driver_id)){
                    $bus_and_driver = BusAndDriver::model()->findByPk($last_bus_driver_id);
                    $bus_and_driver->saveAttributes(array('driver_status'=> 0, 'driver_left_date'=>$model->driver_entered_date));
                }
                $this->redirect(array('CheckedCostConfiguration/Create','id'=>$bus_id,
                    'rid'=>$rid, 'dbq_id'=>$dbq_id,'tid'=>$_GET['tid'],
                ));
            }
        }
        $this->render('create',array(
            'model'=>$model, 'bus_id'=>$bus_id, 'rid'=>$rid,'dbq_id'=>$dbq_id,'tid'=>$_GET['tid'],
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

        if(isset($_POST['BusAndDriver']))
        {
            $model->attributes=$_POST['BusAndDriver'];
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
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('BusAndDriver');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new BusAndDriver('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['BusAndDriver']))
            $model->attributes=$_GET['BusAndDriver'];

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
        $model=BusAndDriver::model()->findByPk($id);
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
        if(isset($_POST['ajax']) && $_POST['ajax']==='bus-and-driver-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}

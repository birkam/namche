<?php

class RouteTimeController extends RController
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
        $model=new RouteTime;
        $checkQ = new CheckQueue();
// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if(isset($_POST['RouteTime']))
        {
            $model->attributes=$_POST['RouteTime'];
            $model->route_id = $_POST['route_id'];
            $model->route_time = $_POST['route_time'];
            $model->payment_type = $_POST['payment_type'];
            $model->status = 1;
            $model->created_date = date('Y-m-d H:i:s', time());
            $model->created_by = Yii::app()->user->user_ac_id;

            $routeTime = RouteTime::model()->findAllByAttributes(array('route_id'=>$model->route_id, 'route_time'=>$model->route_time, 'status'=>1));
            if(empty($routeTime)){
                if($model->save()){
                    $checkQ->route_id = $model->route_id;
                    $checkQ->time_id = $model->id;
                    $checkQ->completed_time = 1;
                    $checkQ->stats = 1;
                    $checkQ->save();
                    $user = Yii::app()->getComponent('user');
                    $user->setFlash(
                        'success',
                        "<strong>$model->route_time inserted successfully. </strong>"
                    );
                }
            }else{
                $user = Yii::app()->getComponent('user');
                $user->setFlash(
                    'error',
                    "<strong>$model->route_time is already..... </strong>"
                );
            }
            $this->redirect(array('Route/View', 'id'=>$model->route_id));
        }

//        $this->render('create',array(
//            'model'=>$model,
//        ));
    }

    public function actionDeactivate(){
        if(isset($_POST['deactivate']))
        {
            $time_id = $_POST['time_id'];
            $route_id = $_POST['route_id'];
            $routeTime = RouteTime::model()->findByPk($time_id);
            $routeTime->saveAttributes(array('status'=>0));
            $this->redirect(array('Route/View', 'id'=>$route_id));
        }
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

        if(isset($_POST['RouteTime']))
        {
            $model->attributes=$_POST['RouteTime'];
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
        $dataProvider=new CActiveDataProvider('RouteTime');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new RouteTime('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['RouteTime']))
            $model->attributes=$_GET['RouteTime'];

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
        $model=RouteTime::model()->findByPk($id);
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
        if(isset($_POST['ajax']) && $_POST['ajax']==='route-time-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}

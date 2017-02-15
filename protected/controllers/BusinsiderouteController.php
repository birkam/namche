<?php

class BusInsideRouteController extends RController
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

    public function actionRemove($id){
        $calendar = new DateConverter();
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
        $busInsideRoute = BusInsideRoute::model()->findByPk($id);
        if($busInsideRoute->saveAttributes(array('bus_status'=>'0','bus_out_date'=>$nepali_date))){
            Yii::app()->user->setFlash('success', "Successfully  Removed!!!");
        }
        $current_user=Yii::app()->user->id;
        $this->redirect(Yii::app()->session['userView'.$current_user.'returnURL']);
    }

    public function actionQueueChart()
    {
        $cmodel=new BusInsideRoute();
        $model=new BusInsideRoute('search');
        if(isset($_GET['BusInsideRoute']))
            $model->attributes=$_GET['BusInsideRoute'];

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);
        $dataProvider = new CActiveDataProvider('BusInsideRoute', array(
            'pagination' => false,
            'criteria' => array(
                'order' => 'queue ASC, bus_id DESC',
            ),
        ));
        $this->render('queueChart',array(
            'dataProvider'=>$dataProvider,
            'model'=>$cmodel //model for creation
        ));

    }
    public function actionOrderAjax()
    {
        if (Yii::app()->request->isPostRequest && isset($_POST['Order']))
        {
            // Since we converted the Javascript array to a string,
            // convert the string back to a PHP array
            $models = explode(',', $_POST['Order']);

            for ($i = 0; $i < sizeof($models); $i++)
            {
                if ($model = BusInsideRoute::model()->findbyAttributes(array('bus_status'=>1, 'bus_id'=>$models[$i])))
                {
                    $model->queue = $i;

                    $model->save();
                }
            }
            print_r($_POST);
        }
        // Handle the regular model order view
        else
        {
            $dataProvider = new CActiveDataProvider('BusInsideRoute', array(
                'pagination' => false,
                'criteria' => array(
                    'order' => 'queue ASC, bus_id DESC',
                ),
            ));

            $this->render('order',array(
                'dataProvider' => $dataProvider,
            ));
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new BusInsideRoute;
        $route_id = @$_GET['id'];
        $modelsearch=new BusInsideRoute('search');
        $modelsearch->unsetAttributes();  // clear any default values
        $modelsearch->route_id = $route_id;
        if(isset($_GET['BusInsideRoute'])) {
            $modelsearch->attributes = $_GET['BusInsideRoute'];
        }
        if(!empty($route_id)){
            $criteria = new CDbCriteria();
            $criteria->condition = 'route_id = :route_id';
            $criteria->order = 'queue DESC';
            $criteria->params = array('route_id' => $route_id);
            $criteria->limit = 1;
            $biqs = BusInsideRoute::model()->findAll($criteria);
            if(!empty($biqs)){
                foreach($biqs as $biq){
                    $lastQueue = $biq->queue;
                }
            }else{
                $lastQueue = -1;
            }
// Uncomment the following line if AJAX validation is needed
            $this->performAjaxValidation($model);

            if(isset($_POST['BusInsideRoute']))
            {
                $model->attributes=$_POST['BusInsideRoute'];
                $model->route_id = $route_id;
                $model->bus_status = '1';
                $model->queue = $lastQueue + 1;
                $model->created_date = date('Y-m-d H:i:s', time());
                $model->created_by = Yii::app()->user->user_ac_id;

                if($model->save()){
                    Yii::app()->user->setFlash('success', "Successfully  Added!!!");
                    $this->redirect(array('busInsideRoute/create/'.$route_id));
                }
            }
        }
        $this->render('create',array(
            'model'=>$model,'modelsearch'=>$modelsearch,'route_id'=>$route_id
        ));
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

        if(isset($_POST['BusInsideRoute']))
        {
            $model->attributes=$_POST['BusInsideRoute'];
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
        $dataProvider=new CActiveDataProvider('BusInsideRoute');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new BusInsideRoute('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['BusInsideRoute']))
            $model->attributes=$_GET['BusInsideRoute'];

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
        $model=BusInsideRoute::model()->findByPk($id);
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
        if(isset($_POST['ajax']) && $_POST['ajax']==='bus-inside-route-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}

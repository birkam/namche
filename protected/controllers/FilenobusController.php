<?php

class FilenoBusController extends RController
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
        $model=new FilenoBus;
        $modelsearch=new FilenoBus('search');
        $modelsearch->unsetAttributes();  // clear any default values
        $modelsearch->owner_status = '1';
        if(isset($_GET['FilenoBus']))
            $modelsearch->attributes=$_GET['FilenoBus'];

// Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if(isset($_POST['FilenoBus']))
        {
            $model->attributes=$_POST['FilenoBus'];
            $model->owner_status = '1';  // status 1 for active owner
            $model->created_by = Yii::app()->user->user_ac_id;
            $model->created_date = date('Y-m-d H:i:s');
            $model->save();
//            if($model->save())
//                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('create',array(
            'model'=>$model,'modelsearch'=>$modelsearch,
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

        if(isset($_POST['FilenoBus']))
        {
            $model->attributes=$_POST['FilenoBus'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }
    public function actionDeactivate(){
        $actionId = $_POST['id'];
        $left_date = $_POST['left_date'];

        $actionDetail = FilenoBus::model()->findByPk($actionId);
        $actionDetail->saveAttributes(array('owner_status' => '0', 'left_date'=>$left_date));
        $this->redirect(array('view','id'=>$actionId));
    }
//    public function actionActivate(){
//        $actionId = $_GET['id'];
//        $actionDetail = FilenoBus::model()->findByPk($actionId);
//        $actionDetail->saveAttributes(array('owner_status' => 1));
//        $this->redirect(array('view','id'=>$actionId));
//    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('FilenoBus');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new FilenoBus('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['FilenoBus']))
            $model->attributes=$_GET['FilenoBus'];

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
        $model=FilenoBus::model()->findByPk($id);
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
        if(isset($_POST['ajax']) && $_POST['ajax']==='fileno-bus-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}

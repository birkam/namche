<?php

class BusController extends RController
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

    public function actionHistory(){
        $this->render('history');
    }
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new Bus;
//        $busAndOwner = new BusAndOwner();
// Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if(isset($_POST['Bus']))
        {
            date_default_timezone_set('Asia/Kathmandu');
            $model->attributes=$_POST['Bus'];
//            $busAndOwner->attributes=$_POST['BusAndOwner'];
            $model->created_by = Yii::app()->user->user_ac_id;
            $model->created_date =  date('Y-m-d H:i:s', time());
//            $owner_id_arr = $busAndOwner->owner_id;
            if($model->save()){
                /*if(!empty($owner_id_arr)){
                    foreach($owner_id_arr as $val){
                        $singleBusAndOwner = new BusAndOwner();
                        $singleBusAndOwner->owner_id = $val;
                        $singleBusAndOwner->bus_id = $model->id;
                        $singleBusAndOwner->owner_date = $busAndOwner->owner_date;
                        $singleBusAndOwner->owner_status = '1';
                        $singleBusAndOwner->left_date = 'NOT LEFT';
                        $singleBusAndOwner->created_by = Yii::app()->user->user_ac_id;
                        $singleBusAndOwner->created_date =  date('Y-m-d H:i:s', time());
                        $singleBusAndOwner->save();
                    }
                }*/
                $this->redirect(array('view','id'=>$model->id));
            }
        }

        $this->render('create',array(
            'model'=>$model,
            //'busAndOwner'=>$busAndOwner,
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
        $this->performAjaxValidation($model);

        if(isset($_POST['Bus']))
        {
            $model->attributes=$_POST['Bus'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }


    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('Bus');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        if ( isset( $_GET[ 'pageSize' ] ) )
        {
            Yii::app()->user->setState( 'pageSize', (int) $_GET[ 'pageSize' ] );
            unset( $_GET[ 'pageSize' ] );
        }
        $model=new Bus('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Bus']))
            $model->attributes=$_GET['Bus'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }
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
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model=Bus::model()->findByPk($id);
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
        if(isset($_POST['ajax']) && $_POST['ajax']==='bus-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}

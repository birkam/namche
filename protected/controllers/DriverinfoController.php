<?php

class DriverInfoController extends RController
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
        $this->render('general_info',array(
            'model'=>$this->loadModel($id),
        ));
    }
    public function actionEmContact(){
        $this->render('emContact');
    }
    public function actionLicenceInfo(){
        $this->render('licenceInfo');
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new DriverInfo;
        $date = date_create();
        $unixdate = date_format($date, 'U');
// Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if(isset($_POST['DriverInfo']))
        {
            date_default_timezone_set('Asia/Kathmandu');
            $model->attributes=$_POST['DriverInfo'];

            $vehArr = @$_POST['checkBoxList'];
            $vehStr = implode(', ', $vehArr);
            $model->licence_authorized_drive = $vehStr;

            $uploadedFile = CUploadedFile::getInstance($model, 'photo');
            if(!empty($uploadedFile)){
                $fileName = $unixdate . '_' . $uploadedFile;  // $timestamp + file name
                $model->photo = $fileName;
            }
            $model->created_date = date('Y-m-d H:i:s', time());
            $model->created_by = Yii::app()->user->user_ac_id;
            if($model->validate()){
                if($model->save()){
                    if (!is_dir(Yii::app()->basePath . '/../images/BusDriver/' . $model->id)) {
                        mkdir(Yii::app()->basePath . '/../images/BusDriver/' . $model->id);
                    }
                    if(!empty($uploadedFile)){
                        $uploadedFile->saveAs(Yii::app()->basePath . '/../images/BusDriver/'. $model->id . '/' . $fileName);
                    }
                    $this->redirect(array('view','id'=>$model->id));
                }
            }
        }

        $this->render('create',array(
            'model'=>$model,
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
        $prevImg = $model->photo;
        $date = date_create();
        $unixdate = date_format($date, 'U');
// Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if(isset($_POST['DriverInfo']))
        {
            $model->attributes=$_POST['DriverInfo'];
            $uploadedFile = CUploadedFile::getInstance($model, 'photo');
            $fileName = $unixdate . '_' . $uploadedFile;  // $timestamp + file name

            if(empty($uploadedFile)){
                $model->photo = $prevImg;
            }else{
                $model->photo = $fileName;
            }
            if($model->save()){
                if (!is_dir(Yii::app()->basePath . '/../images/BusDriver/' . $model->id)) {
                    mkdir(Yii::app()->basePath . '/../images/BusDriver/' . $model->id);
                }
                if(!empty($uploadedFile)){
                    $uploadedFile->saveAs(Yii::app()->basePath . '/../images/BusDriver/'. $model->id . '/' . $fileName);
                }
            }
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
        $dataProvider=new CActiveDataProvider('DriverInfo');
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
        $model=new DriverInfo('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['DriverInfo']))
            $model->attributes=$_GET['DriverInfo'];

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
        $model=DriverInfo::model()->findByPk($id);
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
        if(isset($_POST['ajax']) && $_POST['ajax']==='driver-info-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}

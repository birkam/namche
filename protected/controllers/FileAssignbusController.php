<?php

class FileAssignbusController extends RController
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
        $model=new FileAssignbus;
        $modelsearch=new FileAssignbus('search');
        $modelsearch->unsetAttributes();  // clear any default values
        if(isset($_GET['FileAssignbus'])){
            $modelsearch->attributes=$_GET['FileAssignbus'];
        }
// Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);
        $fileId = $_GET['id'];

        $owner_id_arr = array();
        $file_no_owner = FilenoBus::model()->findAllByAttributes(array('fileno_id'=>$fileId, 'owner_status'=>'1'));
        if(empty($file_no_owner)){
            $user = Yii::app()->getComponent('user');
            $user->setFlash(
                'error',
                "<strong>Selected File No Has No Active Owners.</strong>"
            );
            $this->redirect(array('FilenoBus/Create', 'id'=>$fileId));
        }
        else{
            foreach($file_no_owner as $f_n_o){
                $owner_id = $f_n_o->owner_id;

//                $owners = BusOwner::model()->findByPk($owner_id);
//            echo $owners->fname.' '.$owners->mname.' '.$owners->lname.', ';

                $owner_id_arr[$owner_id]=$owner_id;
            }
            $owner_id_str = implode(', ', $owner_id_arr);
        }


  //      var_dump($owner_id_str);exit;
        $checkfile = FileAssignbus::model()->findAllByAttributes(array('fileno_id'=>$fileId, 'bus_status'=>1));
        if(!empty($checkfile)){

            $user = Yii::app()->getComponent('user');
            $user->setFlash(
                'error',
                "<strong>File No not empty. File No contains the folling bus.</strong>"
            );
            foreach($checkfile as $check){
                $che = $check->id;
                $this->redirect(array('FileAssignbus/view', 'id'=>$che));
            }
        }
        else{
            if(isset($_POST['FileAssignbus']))
            {
                date_default_timezone_set('Asia/Kathmandu');
                $model->attributes=$_POST['FileAssignbus'];
                $model->fileno_id = $fileId;
                $model->owner_id = $owner_id_str;
                $model->bus_status = '1';
                $model->taken_out_date = 'NOT TAKEN';
                $model->created_by = Yii::app()->user->user_ac_id;
                $model->created_date = date('Y-m-d H:i:s', time());
                if($model->save())
                    $this->redirect(array('view','id'=>$model->id));
            }

            $this->render('create',array(
                'model'=>$model,
                'modelsearch'=>$modelsearch,
                'fileId'=>$fileId,
                'owner_id_str'=>$owner_id_str,
            ));
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

        if(isset($_POST['FileAssignbus']))
        {
            $model->attributes=$_POST['FileAssignbus'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }
    public function actionRemove(){
        if(isset($_POST['submit'])){
            $id = $_POST['id'];
            $taken_out_date = $_POST['taken_out_date'];
            $model = FileAssignbus::model()->findByPk($id);
            $model->saveAttributes(array('bus_status' => 0, 'taken_out_date'=> $taken_out_date));
            $this->redirect(Yii::app()->request->baseUrl.'/FileAssignbus/Create/'.$model->fileno_id);
        }
    }
    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
//    public function actionDelete($id)
//    {
//        if(Yii::app()->request->isPostRequest)
//        {
//// we only allow deletion via POST request
//            $this->loadModel($id)->delete();
//
//// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
//            if(!isset($_GET['ajax']))
//                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
//        }
//        else
//            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
//    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('FileAssignbus');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new FileAssignbus('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['FileAssignbus']))
            $model->attributes=$_GET['FileAssignbus'];

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
        $model=FileAssignbus::model()->findByPk($id);
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
        if(isset($_POST['ajax']) && $_POST['ajax']==='file-assignbus-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}

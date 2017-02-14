<?php

class FileNoController extends RController
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


    public function actionCreateFileNo(){
        $this->render('File');
    }
    public function actionCheckUser(){
        $recentusername = $_POST['username'];
        $recentpassword = sha1(md5($_POST['password']));
        $logged_in_userId = Yii::app()->user->user_ac_id;
        $logged_in_user = UserAccount::model()->findByPk($logged_in_userId);
        if(!empty($logged_in_user)){
            $alreadyusername = $logged_in_user->user_name;
            $alreadyuserpassword = $logged_in_user->password;

            if($recentusername == $alreadyusername && $recentpassword == $alreadyuserpassword){
                echo 'yes';
            }else{
                $this->redirect(array('CreateFileNo'));
            }
        }
    }



    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new FileNo;

// Uncomment the following line if AJAX validation is needed
 $this->performAjaxValidation($model);

        if(isset($_POST['FileNo']))
        {
            $model->attributes=$_POST['FileNo'];
            $model->created_by = Yii::app()->user->user_ac_id;
            $model->created_date = date('Y-m-d H:i:s');

            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
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

// Uncomment the following line if AJAX validation is needed
 $this->performAjaxValidation($model);

        if(isset($_POST['FileNo']))
        {
            $model->attributes=$_POST['FileNo'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }


    public function actionOwnerHistory(){
        $file_id = @$_POST['id'];
        if(!empty($file_id)){
            //findAll(array('order'=>'somefield', 'condition'=>'otherfield=:x', 'params'=>array(':x'=>$x)));
            if($file_id == 'all'){
                $criteria = new CDbCriteria();
//            $criteria->condition = 'fileno_id = :fileno_id';
//            $criteria->group = 'owner_status';
                $criteria->order = 'owner_status DESC';
//            $criteria->params = array('fileno_id' => $file_id);
                $filenoBus = FilenoBus::model()->findAll($criteria);
            }else{
                $criteria = new CDbCriteria();
                $criteria->condition = 'fileno_id = :fileno_id';
//            $criteria->group = 'owner_status';
                $criteria->order = 'owner_status DESC';
                $criteria->params = array('fileno_id' => $file_id);
                $filenoBus = FilenoBus::model()->findAll($criteria);
//            var_dump($filenoBus);}


            }


        }else{
            $filenoBus = null;
        }
        $this->render('ownerHistory', array('model'=>$filenoBus, 'file_id'=>$file_id));
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
        $dataProvider=new CActiveDataProvider('FileNo');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new FileNo('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['FileNo']))
            $model->attributes=$_GET['FileNo'];

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
        $model=FileNo::model()->findByPk($id);
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
        if(isset($_POST['ajax']) && $_POST['ajax']==='file-no-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}

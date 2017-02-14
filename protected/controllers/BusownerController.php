<?php

class BusOwnerController extends RController
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
        $this->render('busOwnerView',array(
            'model'=>$this->loadModel($id),
        ));
    }
    public function actionTempAddress(){
        $this->render('tempAddress');
    }
    public function actionPerAddress(){
        $this->render('perAddress');
    }

    public function actionAttachments(){
        $this->render('attachments');
    }
    public function actionContactInfo(){
        $this->render('contactInfo');
    }
    public function actionEmContactInfo(){
        $this->render('emContactInfo');
    }
    public function actionLoadDistrict()
    {
        $data=District::model()->findAll('zone_id=:zone_id',
            array(':zone_id'=>(int) $_POST['id']));

        $data=CHtml::listData($data,'id','district_name');

        echo "<option value=''>Select District</option>";
        foreach($data as $value=>$city_name)
            echo CHtml::tag('option', array('value'=>$value),CHtml::encode($city_name),true);
    }
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new BusOwner;
        $date = date_create();
        $unixdate = date_format($date, 'U');
        $busOwnAttach = new BusownerAttachments;
        $tempAddress = new TempAddress;
//      $perAddress = new PerAddress;
        $busOwnContact=new BusOwnerContact;
        $busOwnEmContact=new BusOwnerEmergencyContact;
// Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model, $busOwnAttach, $tempAddress, $busOwnContact, $busOwnEmContact);

        if(isset($_POST['BusOwner'], $_POST['BusownerAttachments'], $_POST['TempAddress'], $_POST['BusOwnerContact'], $_POST['BusOwnerEmergencyContact']))
        {
            $model->attributes=$_POST['BusOwner'];
            $busOwnAttach->attributes=$_POST['BusownerAttachments'];
            $tempAddress->attributes=$_POST['TempAddress'];
//            $perAddress->attributes=$_POST['PerAddress'];
            $busOwnContact->attributes=$_POST['BusOwnerContact'];
            $busOwnEmContact->attributes=$_POST['BusOwnerEmergencyContact'];

            $model->created_by = Yii::app()->user->user_ac_id;
            $model->created_date = date('Y-m-d H:i:s');

            $uploadedFile = CUploadedFile::getInstance($model, 'photo');
            $fileName = $unixdate.'_' .$uploadedFile;  // $timestamp + file name
            $model->photo = $fileName;

            $images = CUploadedFile::getInstancesByName('img');

            if($model->validate() && $busOwnAttach->validate() && $tempAddress->validate()  && $busOwnContact->validate() && $busOwnEmContact->validate()){
                if($model->save()){
                    if (!is_dir(Yii::app()->basePath . '/../images/BusOwner/'. $model->id)) {
                        mkdir(Yii::app()->basePath . '/../images/BusOwner/'. $model->id);
                    }
                    if(!empty($uploadedFile)){
                        $uploadedFile->saveAs(Yii::app()->basePath . '/../images/BusOwner/'. $model->id . '/' . $fileName);
                    }
                    if(!empty($busOwnAttach)){
                        if (!is_dir(Yii::app()->basePath . '/../images/BusOwner/'. $model->id .'/Attachments/')) {
                            mkdir(Yii::app()->basePath . '/../images/BusOwner/'. $model->id .'/Attachments/');
                        }
                        foreach($images as $image=>$i){
                            echo $image = $i->name;
                            $i->saveAs(Yii::app()->basePath.'/../images/BusOwner/'. $model->id . '/Attachments/' . $image);
                            $model1=new BusownerAttachments();
                            $model1->busOwnerId = $model->id;
                            $model1->image = $image;
                            $model1->description = $busOwnAttach->description;
                            $model1->created_by = Yii::app()->user->user_ac_id;
                            $model1->created_date = date('Y-m-d H:i:s');
                            $model1->save();
                        }
                    }
                    if(!empty($tempAddress)){
                        $tempAddress->busOwnerId = $model->id;
                        $tempAddress->created_by = Yii::app()->user->user_ac_id;
                        $tempAddress->created_date = date('Y-m-d H:i:s');
                        $tempAddress->save();
                    }
//                    if(!empty($perAddress)){
//                        $perAddress->busOwnerId = $model->id;
//                        $perAddress->created_by = Yii::app()->user->user_ac_id;
//                        $perAddress->created_date = date('Y-m-d H:i:s');
//                        $perAddress->save();
//                    }
                    if(!empty($busOwnContact)){
                        $busOwnContact->busOwnerId = $model->id;
                        $busOwnContact->created_by = Yii::app()->user->user_ac_id;
                        $busOwnContact->created_date = date('Y-m-d H:i:s');
                        $busOwnContact->save();
                    }
                    if(!empty($busOwnEmContact)){
                        $busOwnEmContact->busOwnerId = $model->id;
                        $busOwnEmContact->created_by = Yii::app()->user->user_ac_id;
                        $busOwnEmContact->created_date = date('Y-m-d H:i:s');
                        $busOwnEmContact->save();
                    }
                    $this->redirect(array('view','id'=>$model->id, 'ref'=>'oi'));
                }
            }
        }
        $this->render('create',array('model'=>$model, 'busOwnAttach'=>$busOwnAttach,
            'tempAddress'=>$tempAddress,
//            'perAddress'=>$perAddress,
            'busOwnContact'=>$busOwnContact,
            'busOwnEmContact'=>$busOwnEmContact,
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
        $this->performAjaxValidation1($model);

        if(isset($_POST['BusOwner']))
        {
            $model->attributes=$_POST['BusOwner'];

            $uploadedFile = CUploadedFile::getInstance($model, 'photo');
            $fileName = $unixdate.'_'.$uploadedFile;  // $timestamp + file name

            if(empty($uploadedFile)){
                $model->photo = $prevImg;
            }else{
                $model->photo = $fileName;
            }

            if($model->save()){
                if (!is_dir(Yii::app()->basePath . '/../images/BusOwner/' . $model->id)) {
                    mkdir(Yii::app()->basePath . '/../images/BusOwner/' . $model->id);
                }
                if(!empty($uploadedFile)){
                    $uploadedFile->saveAs(Yii::app()->basePath . '/../images/BusOwner/'. $model->id . '/' . $fileName);
                }
            }
            $this->redirect(array('view','id'=>$model->id, 'ref'=>'oi'));
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
        $dataProvider=new CActiveDataProvider('BusOwner');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new BusOwner('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['BusOwner']))
            $model->attributes=$_GET['BusOwner'];

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
        $model=BusOwner::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model, $busOwnAttach, $tempAddress, $busOwnContact, $busOwnEmContact)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='bus-owner-form')
        {
            echo CActiveForm::validate(array($model, $busOwnAttach, $tempAddress, $busOwnContact, $busOwnEmContact));
            Yii::app()->end();
        }
    }
    protected function performAjaxValidation1($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='bus-owner-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}

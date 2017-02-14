<?php

class RouteCostController extends RController
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
			//		'postOnly + delete', // we only allow deletion via POST request
		);
	}

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
		$model=new RouteCost;

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

		if(isset($_POST['RouteCost']))
		{
			$model->attributes=$_POST['RouteCost'];
			$model->route_id = $_POST['route_id'];
			$model->samiti_sulka = $_POST['samiti_sulka'];
			$model->bhalai_kosh = $_POST['bhalai_kosh'];
			$model->samrakshan = $_POST['samrakshan'];
			$model->ticket = $_POST['ticket'];
			$model->sahayog = $_POST['sahayog'];
			$model->bima = $_POST['bima'];
			$model->bibidh = $_POST['bibidh'];
			$model->mandir = $_POST['mandir'];
			$model->jokhim = $_POST['jokhim'];
			$model->anugaman = $_POST['anugaman'];
			$model->bi_bya_sulka = $_POST['bi_bya_sulka'];
			$model->ma_kosh = $_POST['ma_kosh'];
			$model->cost_status = 1;
			$model->created_date = date('Y-m-d H:i:s', time());
			$model->created_by = Yii::app()->user->user_ac_id;

//            $prevRouteCost = RouteCost::model()->findAllByAttributes(array('route_id'=>$model->route_id,  'samiti_sulka'=>$model->samiti_sulka, 'cost_status'=>1));
//            if(empty($prevRouteCost)){
			$prevRouteCostUpdate = RouteCost::model()->findAllByAttributes(array('route_id'=>$model->route_id, 'cost_status'=>1));
			if(empty($prevRouteCostUpdate)) {
				if ($model->save()) {
//                }
					$user = Yii::app()->getComponent('user');
					$user->setFlash(
						'success',
						"<strong>inserted successfully. </strong>"
					);
				}
			}
			else{
                $user = Yii::app()->getComponent('user');
                $user->setFlash(
                    'info',
                    "<strong>We Have Active Cost Already. </strong>"
                );
            }
			$this->redirect(array('Route/View', 'id'=>$model->route_id));
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

		if(isset($_POST['RouteCost']))
		{
			$model->attributes=$_POST['RouteCost'];
            $user = Yii::app()->getComponent('user');
            if($model->save()){
                $user->setFlash(
                    'success',
                    "<strong>Successfully Updated. </strong>"
                );
                $this->redirect(array('Route/View', 'id'=>$model->route_id));
            }
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
		$dataProvider=new CActiveDataProvider('RouteCost');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new RouteCost('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['RouteCost']))
			$model->attributes=$_GET['RouteCost'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return RouteCost the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=RouteCost::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param RouteCost $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='route-cost-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

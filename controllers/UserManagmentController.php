<?php
namespace app\controllers;

use app\models\UserModel;
use Yii;
use app\models\SignupForm;
use app\components\AdminController;
use yii\web\Response;
use yii\widgets\ActiveForm;

class UserManagmentController extends AdminController
{
    public function actionIndex()
    {
        $dataProvider = UserModel::search();

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionCreate()
    {
        $model = new SignupForm;

        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            } else {
                if ($model->signup()) {
                    $this->setFlash('success', Yii::t('app', 'User has been created'));
                } else {
                    $this->setFlash('error', Yii::t('app', 'User has not been created'));
                }
                return $this->redirect(['index']);
            }
        }

        return $this->render('form', [
            'model' => $model,
        ]);
    }

    public function actionUpdate()
    {

    }
}
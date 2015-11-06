<?php
namespace app\controllers;

use app\models\UserModel;
use Yii;
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
        $model = new userModel;
        $model->scenario = userModel::SCENARIO_SIGNUP;

        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            } else {
                if ($model->save()) {
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

    public function actionChangePassword()
    {
        $model = userModel::findIdentity(Yii::$app->user->id);
        $model->scenario = userModel::SCENARIO_CHANGE_PASSWORD;

        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            } else {
                if ($model->save()) {
                    $this->setFlash('success', Yii::t('app', 'Password has been updated'));
                } else {
                    $this->setFlash('error', Yii::t('app', 'Password has not been updated'));
                }
                return $this->redirect(['index']);
            }
        }

        return $this->render('form', ['model' => $model]);
    }

    public function actionProfile()
    {
        $model = userModel::findIdentity(Yii::$app->user->id);
        $model->scenario = userModel::SCENARIO_PROFILE;

        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            } else {
                if ($model->save()) {
                    $this->setFlash('success', Yii::t('app', 'User has been updated'));
                } else {
                    $this->setFlash('error', Yii::t('app', 'User has not been updated'));
                }
                return $this->redirect(['index']);
            }
        }

        return $this->render('form', ['model' => $model]);
    }
}
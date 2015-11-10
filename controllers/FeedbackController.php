<?php
namespace app\controllers;

use app\models\FeedbackSearch;
use Yii;
use app\components\AdminController;
use app\models\Feedback;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\widgets\ActiveForm;

class FeedbackController extends AdminController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['form'],
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $statuses = \app\models\Feedback::statuses();
        $searchModel = new FeedbackSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'statuses' => $statuses
        ]);
    }

    public function actionForm()
    {
        $model = new Feedback;
        $request = Yii::$app->request;

        if ($request->isAjax) {
            if ($model->load($request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;

                if ($model->save()) {
                    return ['status' => 'success'];
                } else {
                    return ActiveForm::validate($model);
                }
            }
        }

        return $this->redirect(['/']);
    }

    public function actionDelete($id)
    {
        if ($this->findModel(Feedback::className(), $id)->delete() !== false)
            $this->setFlash('success', \Yii::t('app', 'Modifications have been saved'));
        else
            $this->setFlash('error', \Yii::t('app', 'Modifications have not been saved'));

        return $this->redirect(['/feedback/index']);
    }

    public function actionChangeStatus($status, $id)
    {
        $model = Feedback::findOne($id);
        $model->status = $status;
        Yii::$app->response->format = Response::FORMAT_JSON;
        if ($model->save()) {
            return ['result' => 'success'];
        }
        return ['result' => 'error'];
    }

    public function actionTest($a,$b)
    {

    }
}
<?php
namespace app\controllers;

use app\components\AdminController;
use app\models\Profile;
use himiklab\sortablegrid\SortableGridAction;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

class ProfileController extends AdminController
{
    public function actions()
    {
        return [
            'sort' => [
                'class' => SortableGridAction::className(),
                'modelName' => Profile::className(),
            ],
        ];
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['post'],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        $statuses = \app\models\Profile::statuses();
        $dataProvider = Profile::search();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'statuses' => $statuses
        ]);
    }

    public function actionCreate()
    {
        return $this->actionUpdate(true);
    }

    public function actionUpdate($new = false)
    {
        if ($new === true) {
            $model = new Profile;
            $model->scenario = Profile::SCENARIO_INSERT;
        } else {
            $model = $this->findModel(Profile::className(), \Yii::$app->request->get('id'));
        }

        if ($model->load(\Yii::$app->request->post())) {
            if ($model->save()) {
                $this->setFlash('success', \Yii::t('app', 'Image has been saved'));
            } else {
                $this->setFlash('error', \Yii::t('app', 'Image has not been saved'));
            }
            return $this->redirect('/profile/index');
        }

        return $this->render('form', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        if ($this->findModel(Profile::className(), $id)->delete() !== false)
            $this->setFlash('success', \Yii::t('app', 'Modifications have been saved'));
        else
            $this->setFlash('error', \Yii::t('app', 'Modifications have not been saved'));

        return $this->redirect(['/profile/index']);
    }
}
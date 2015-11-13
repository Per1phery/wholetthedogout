<?php
namespace app\controllers;

use app\components\AdminController;
use app\models\Mention;
use himiklab\sortablegrid\SortableGridAction;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

class MentionController extends AdminController
{
    public function actions()
    {
        return [
            'sort' => [
                'class' => SortableGridAction::className(),
                'modelName' => Mention::className(),
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

    public function actionIndex($type)
    {
        $statuses = Mention::statuses();
        $dataProvider = Mention::search($type);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'statuses' => $statuses
        ]);
    }

    public function actionCreate($type)
    {
        $model = new Mention;
        $model->scenario = Mention::SCENARIO_INSERT;
        $model->type = $type;

        if ($model->load(\Yii::$app->request->post())) {
            if ($model->save()) {
                $this->setFlash('success', \Yii::t('app', 'Image has been saved'));
            } else {
                $this->setFlash('error', \Yii::t('app', 'Image has not been saved'));
            }

            return $this->redirect(['index','type' => $model->type]);
        }

        return $this->render('form', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel(Mention::className(), $id);

        if ($model->load(\Yii::$app->request->post())) {
            if ($model->save()) {
                $this->setFlash('success', \Yii::t('app', 'Image has been saved'));
            } else {
                $this->setFlash('error', \Yii::t('app', 'Image has not been saved'));
            }

            return $this->redirect(['index','type' => $model->type]);
        }

        return $this->render('form', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel(Mention::className(), $id);
        $type = $model->type;

        if ($model->delete() !== false)
            $this->setFlash('success', \Yii::t('app', 'Modifications have been saved'));
        else
            $this->setFlash('error', \Yii::t('app', 'Modifications have not been saved'));

        return $this->redirect(['index','type' => $type]);
    }
}
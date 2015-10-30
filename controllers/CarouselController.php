<?php
namespace app\controllers;

use app\components\AdminController;
use app\models\Carousel;
use himiklab\sortablegrid\SortableGridAction;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

class CarouselController extends AdminController
{
    public function actions()
    {
        return [
            'sort' => [
                'class' => SortableGridAction::className(),
                'modelName' => Carousel::className(),
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
        $statuses = \app\models\Carousel::statuses();
        $dataProvider = Carousel::search();

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
            $model = new Carousel;
            $model->scenario = Carousel::SCENARIO_INSERT;
        } else {
            $model = $this->findModel(Carousel::className(), \Yii::$app->request->get('id'));
        }

        if ($model->load(\Yii::$app->request->post())) {
            if ($model->save()) {
                $this->setFlash('success', \Yii::t('app', 'Image has been saved'));
            } else {
                $this->setFlash('error', \Yii::t('app', 'Image has not been saved'));
            }
            return $this->redirect('/carousel/index');
        }

        return $this->render('form', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        if ($this->findModel(Carousel::className(), $id)->delete() !== false)
            $this->setFlash('success', \Yii::t('app', 'Modifications have been saved'));
        else
            $this->setFlash('error', \Yii::t('app', 'Modifications have not been saved'));

        return $this->redirect(['/carousel/index']);
    }
}
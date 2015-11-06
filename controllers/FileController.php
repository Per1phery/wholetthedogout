<?php

namespace app\controllers;

use app\components\AdminController;
use app\models\File;

class FileController extends AdminController
{
    public function actionIndex()
    {
        return $this->actionCrteate();
    }

    public function actionCrteate()
    {
        $model = new File;

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            if ($model->save()) {
                $this->setFlash('success', \Yii::t('app', 'Modifications have been saved'));
            } else {
                $this->setFlash('error', \Yii::t('app', 'Modifications have been saved'));
            }

            return $this->redirect(['index']);
        }

        return $this->render('index', [
            'model' => $model
        ]);
    }
}
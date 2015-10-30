<?php
namespace app\controllers;

use app\components\AdminController;
use app\models\Settings;

class SettingsController extends AdminController
{
    public function actionIndex()
    {
        $dataProvider = Settings::search();

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel(Settings::className(), $id);

        if ($model->load(\Yii::$app->request->post())) {
            if ($model->save()) {
                $this->setFlash('success', \Yii::t('app', 'Modifications have been saved'));
            } else {
                $this->setFlash('error', \Yii::t('app', 'Modifications have not been saved'));
            }
            return $this->redirect('/settings/index');
        }

        return $this->render('form', [
            'model' => $model
        ]);
    }
}
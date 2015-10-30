<?php
namespace app\modules\admin\controllers;

use app\components\AdminController;

class MainController extends AdminController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
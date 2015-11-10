<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini"></span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                <li>
                    <?= Html::a(Yii::t('app', 'To site'), Yii::$app->homeUrl, ['target' => 'blank']) ?>
                </li>
                <li>
                    <?= Html::a(Yii::t('app', 'Sign out'), ['/site/logout'], ['data-method' => 'post']) ?>
                </li>
            </ul>
        </div>
    </nav>
</header>

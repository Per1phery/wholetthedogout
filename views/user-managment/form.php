<?php
$form = \yii\widgets\ActiveForm::begin([
    'enableClientValidation' => false,
    'enableAjaxValidation' => true,
]);
?>

<?php if ($model->getScenario() === app\models\userModel::SCENARIO_PROFILE ||
    $model->getScenario() === app\models\userModel::SCENARIO_SIGNUP
): ?>
    <?= $form->field($model, 'login'); ?>
    <?= $form->field($model, 'email'); ?>
<?php endif; ?>
<?php if ($model->getScenario() === app\models\userModel::SCENARIO_CHANGE_PASSWORD): ?>
    <?= $form->field($model, 'oldPassword')->passwordInput(); ?>
<?php endif; ?>
<?php if ($model->getScenario() === app\models\userModel::SCENARIO_CHANGE_PASSWORD ||
    $model->getScenario() === app\models\userModel::SCENARIO_SIGNUP
): ?>
    <?= $form->field($model, 'password')->passwordInput(); ?>
    <?= $form->field($model, 'confirmPassword')->passwordInput(); ?>
<?php endif; ?>

<?= \yii\helpers\Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']); ?>
<?php $form->end(); ?>
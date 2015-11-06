<?php
$form = \yii\widgets\ActiveForm::begin([
    'enableClientValidation' => false,
    'enableAjaxValidation' => true,
]);
?>

<?= $form->field($model, 'oldPassword')->passwordInput(); ?>
<?= $form->field($model, 'password')->passwordInput(); ?>
<?= $form->field($model, 'confirmPassword')->passwordInput(); ?>

<?= \yii\helpers\Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']); ?>

<?php $form->end(); ?>
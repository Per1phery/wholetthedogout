<?php
$form = \yii\widgets\ActiveForm::begin([
    'enableClientValidation' => false,
    'enableAjaxValidation' => true,
]);
?>

<?= $form->field($model, 'login'); ?>
<?= $form->field($model, 'email'); ?>
<?= $form->field($model, 'password')->passwordInput(); ?>
<?= \yii\helpers\Html::a(Yii::t('app', 'List'), ['index'], ['class' => 'btn btn-info']) ?>
    &nbsp;
<?= \yii\helpers\Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']); ?>

<?php $form->end(); ?>
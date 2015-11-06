<?php
$form = \yii\widgets\ActiveForm::begin([
    'enableClientValidation' => false,
    'enableAjaxValidation' => true,
]);
?>

<?= $form->field($model, 'login'); ?>
<?= $form->field($model, 'email'); ?>

<?= \yii\helpers\Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']); ?>

<?php $form->end(); ?>
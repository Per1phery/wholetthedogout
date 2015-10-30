<?php
$form = \yii\widgets\ActiveForm::begin([

]);
?>

<?= $form->field($model, 'title'); ?>
<?= $form->field($model, 'value'); ?>
<?= \yii\helpers\Html::a(\Yii::t('app', 'List'), ['index'], ['class' => 'btn btn-info']); ?>
&nbsp;
<?= \yii\helpers\Html::submitButton(\Yii::t('app', 'Save'), ['class' => 'btn btn-primary']); ?>

<?php  $form->end(); ?>
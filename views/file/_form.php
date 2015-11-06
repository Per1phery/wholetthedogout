<?php
$form = \yii\widgets\ActiveForm::begin([
    'options' => ['enctype'=>'multipart/form-data'],
]);
?>

<?= $form->field($model, 'file')->fileInput(['class' => 'btn btn-primary'])->label(\Yii::t('app', 'File')); ?>
<?= \yii\helpers\Html::submitButton(\Yii::t('app', 'Save'), ['class' => 'btn btn-primary']); ?>

<?php  $form->end(); ?>
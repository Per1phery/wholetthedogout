<?php
/**
 * $model Carousel model
 */
?>
<?php $form = \yii\bootstrap\ActiveForm::begin([
    'enableClientValidation' => true,
    'options' => ['enctype'=>'multipart/form-data'],
]);?>

<?=$form->field($model, 'image_tmp')->fileInput(['class' => 'btn btn-primary'])->label(Yii::t('app', 'Image'));?>
<?=$form->field($model, 'link');?>
<?=$form->field($model, 'status')->dropDownList(\app\models\Carousel::statuses());?>
<?= \yii\helpers\Html::a(\Yii::t('app', 'List'), ['index'], ['class' => 'btn btn-info']) ?>
&nbsp;
<?=\yii\helpers\Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']);?>

<?php $form->end();?>

<?php
$form = \yii\widgets\ActiveForm::begin([
        'id' => 'feedback_form',
        'action' => ['/feedback/form'],
        'enableAjaxValidation' => false
    ]);
?>
<?= $form->field($feedback, 'phone'); ?>
<?= \yii\helpers\Html::submitButton()?>
<?php $form->end(); ?>
<?php
    $this->registerJs("
    $('body').on('beforeSubmit', 'form#feedback_form', function () {
    var form = $(this);
    // return false if form still have some validation errors
    if (form.find('.has-error').length) {
        return false;
    }
    // submit form
    $.ajax({
        url: form.attr('action'),
        type: 'post',
        data: form.serialize(),
        success: function (data) {
            if (data.status === 'success') {
                console.log('success');
            }
        }
    });
    return false;
    });
    ", \yii\web\View::POS_END, 'my-options');
?>

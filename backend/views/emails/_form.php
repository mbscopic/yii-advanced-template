<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Emails */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="emails-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'receiver_name')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'receiver_email')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'attachment')->fileInput(['rows' => 1]) ?>

    <?= $form->field($model, 'subject')->textarea(['rows' => 1]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

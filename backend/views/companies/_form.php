<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Companies */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="companies-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'email')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'file')->fileInput() ?>

    <?= $form->field($model, 'company_email')->textarea(['rows' => 1]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

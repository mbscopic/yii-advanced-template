<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\settings\models\Companies */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="companies-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'start_date')->widget(
        \dosamigos\datepicker\DatePicker::className(), [
        // inline too, not bad
        'inline' => false,
        // modify template for custom rendering
        //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]);?>

    <?= $form->field($model, 'email')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'created_date')->textInput() ?>

    <?= $form->field($model, 'company_email')->textarea(['rows' => 1]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
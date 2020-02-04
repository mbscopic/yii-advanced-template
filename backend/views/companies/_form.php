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

    <?= $form->field($branch, 'name')->textarea(['rows' => 1]) ?>

    <?= $form->field($branch, 'address')->textarea(['rows' => 1]) ?>

    <?= $form->field($branch, 'created_date')->textInput() ?>

    <?= $form->field($branch, 'id_company')->dropDownList(
        \yii\helpers\ArrayHelper::map(\backend\models\Branches::find()->all(), 'id', 'name'),
        ['promt' => 'Select Company']
    ) ?>

    <?= $form->field($branch, 'status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

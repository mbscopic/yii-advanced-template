<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Departments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="departments-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_branch')->dropDownList(
            \yii\helpers\ArrayHelper::map(\backend\models\Branches::find()->all(), 'id', 'name'),
            ['promt' => 'Select Branch']
    ) ?>

    <?= $form->field($model, 'id_company')->dropDownList(
        \yii\helpers\ArrayHelper::map(\backend\models\Companies::find()->all(), 'id', 'name'),
        ['promt' => 'Select Company']
    ) ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 1]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

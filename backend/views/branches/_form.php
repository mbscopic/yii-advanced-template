<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Branches */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="branches-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'id_company')->widget(\kartik\select2\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\backend\models\Companies::find()->all(), 'id', 'name'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select a company ...'],
        'pluginOptions' => ['allowClear' => true],
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

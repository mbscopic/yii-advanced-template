<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Customers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zip_code')->dropDownList(\yii\helpers\ArrayHelper::map(\backend\models\Locations::find()->all(), 'id', 'zip_code'), ['prompt' => 'Select zip code', 'id' => 'zip_code']) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'province')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$script = <<< JS
    $("#zip_code").change(function() {
        var zip_id = $(this).val();
      $.get("index.php?r=locations/get-city-province", {zip_id : zip_id}, function(data) {
          var data = $.parseJSON(data);
        $("#customers-city").attr("value", data.city);
        $("#customers-province").attr("value", data.province);
      })
    });

JS;

$this->registerJs($script);

?>


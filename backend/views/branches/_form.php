<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Branches */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="branches-form">

    <?php $form = ActiveForm::begin([
        'id' => 'form',
        'enableAjaxValidation' => true,
        'validationUrl' => \yii\helpers\Url::toRoute('branches/validation'),
    ]); ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'created_date')->textInput() ?>

    <?= $form->field($model, 'id_company')->dropDownList(
        \yii\helpers\ArrayHelper::map(\backend\models\Branches::find()->all(), 'id', 'name'),
        ['promt' => 'Select Company']
    ) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$script = <<< JS
$("#form").on("beforeSubmit", function(e) {
  var form = $(this);
  $.post(form.attr('action'), form.serialize()).done(function(result) {
      console.log(result);
    if (result == 1) {
        $(form).trigger("reset");
        $.pjax.reload({container: "#grid"});
    } else {
        $("#message").html(result.message);
    }
  }).fail(function() {
    console.log("server error");
  });
  
  return false;
});

JS;
$this->registerJs($script);

?>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BranchesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Branches';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branches-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::button('Create Branch', ['value' => \yii\helpers\Url::to('index.php?r=branches/create'), 'class' => 'btn btn-primary', 'id' => 'modalButton']) ?>
    </p>

    <?php
        \yii\bootstrap\Modal::begin([
            'header' => '<h4>Branches</h4>',
            'id' => 'modal',
            'size' => 'modal-lg'
        ]);

        echo "<div id='modalContent'></div>";
        \yii\bootstrap\Modal::end();
    ?>

    <?php
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
        'name',
        'status',
        ['class' => 'yii\grid\ActionColumn'],
    ];
    echo \kartik\export\ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns
    ]);
    ?>

    <?php \yii\widgets\Pjax::begin(['id' => 'grid']); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function($model) {
            if ($model->status == 'inactive') {
                return ['class' => 'danger'];
            } else if ($model->status == 'active'){
                return ['class' => 'success'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['attribute' => 'companyName', 'value' => 'company.name'],
            'name:ntext',
            'address:ntext',
            'created_date',
            'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end()?>

</div>

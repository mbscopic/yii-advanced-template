<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\settings\models\CompaniesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Companies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="companies-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Companies', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php \yii\widgets\Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name:ntext',
            'email:ntext',
            'address:ntext',
            [
                'attribute' => 'start_date',
                'value' => 'start_date',
                'format' => 'raw',
                'filter' => \dosamigos\datepicker\DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'start_date',
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-m-d'
                    ]
                ])
            ],
            'created_date',
            //'company_email:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php \yii\widgets\Pjax::end(); ?>

</div>
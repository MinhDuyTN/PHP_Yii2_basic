<?php

use app\models\Customer;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\CustomerSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Customers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Customer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'note:text',
            'dob',
            // 'province_id',
            [
                'attribute' => 'province_id',
                'value' => function ($model) {
                    return $model->province ? $model->province->name : null;
                },
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\Province::find()->all(), 'id', 'name'),
            ],
//            'district_id',
            [
                'attribute' => 'district_id',
                'value' => function ($model) {
                    return $model->district ? $model->district->name : null;
                },
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\District::find()->all(), 'id', 'name'),
            ],
            [
                'attribute' => 'district_id',
                'value' => function ($model) {
                    return $model->ward ? $model->ward->name : null;
                },
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\Ward::find()->all(), 'id', 'name'),
            ],
            'address',
            //'created_at',
            //'updated_at',
            'created_by',
            //'is_deleted',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Customer $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
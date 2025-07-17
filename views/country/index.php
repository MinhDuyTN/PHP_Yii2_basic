<?php

use app\models\Country;
use yii\bootstrap5\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\CountrySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Countries';
$this->params['breadcrumbs'][] = $this->title;


Modal::begin([
    'title' => 'Country Detail',
    'id' => 'country-modal',
    'size' => Modal::SIZE_LARGE,
]);

// This is where AJAX content will go
echo '<div id="modal-content">Loading...</div>';

Modal::end();

$script = <<<JS
$('body').on('click', '.view-country', function(e) {
    e.preventDefault(); // Stop the link from navigating to another page

    var url = $(this).attr('href'); // Get the URL from the <a> tag

    // Open the modal and load the content from the server via AJAX
    $('#country-modal').modal('show')
        .find('#modal-content')
        .load(url); // jQuery will send AJAX GET to that URL
});

$('body').on('click', '.edit-country', function(e) {
    e.preventDefault(); // Stop the link from navigating to another page
    var url = $(this).attr('href'); // Get the URL from the <a> tag
    // Open the modal and load the content from the server via AJAX
    $('#country-modal').modal('show')
    .find('#modal-content')
    .load(url); // jQuery will send AJAX GET to that URL
});
JS;

$this->registerJs($script);
?>
<div class="country-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Country', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'code',
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function($model) {
                    $nameLink = \yii\helpers\Html::a($model->name, ['view', 'code' => $model->code],[
                        'class' => 'view-country',
                        'data-pjax' => '0',
                    ]);
                    //edit icon
                    $editIcon = \yii\helpers\Html::a(
                            '<i class="bi bi-pen"></i>',
                            ['update', 'code' => $model->code],
                        [
                                'class' => 'edit-country',
                            'title' => 'Edit'
                        ]);

                    return $nameLink . $editIcon;
                },
            ],
            'population',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Country $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'code' => $model->code]);
                }
            ],
        ],
    ]); ?>


</div>

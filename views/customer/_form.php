<?php

use app\models\Province;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;


/** @var yii\web\View $this */
/** @var app\models\Customer $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput([
                'maxlength' => true,
                'class' => 'form-control',
            ]) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'dob')->widget(DatePicker::class, [
                'type' => DatePicker::TYPE_INPUT,
                'options' => [
                    'placeholder' => 'Enter birth date ...',
                    'class' => 'form-control',
                    'required' => true,
                ],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                ]
            ]) ?>
        </div>
    </div>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

<!--    --><?php //= $form->field($model, 'dob')->textInput() ?>



<!--    --><?php //= $form->field($model, 'province_id')->textInput()->label('Province') ?>
<div class = "row">
    <div class="col-md-4">
        <?= $form->field($model,'province_id')->widget(Select2::class, [
            'data' => ArrayHelper::map(Province::find()->all(),'id','name'),
            'options' => ['placeholder' => 'Select province',
            ],
            'pluginOptions' => ['allowClear' => true],
        ])
        ->label('Province') ?>
    </div>
    <div class="col-md-4">
<!--    --><?php //= $form->field($model, 'district_id')->textInput() ?>

    <?= $form->field($model,'district_id')->widget(DepDrop::class, [
        'options' => [
            'id'=>'district_id',
        ],
        'pluginOptions' => [
            'depends' => ['customer-province_id'],
            'placeholder' => 'Select district',
            'url' => Url::to(['/customer/get-districts']) // change this to match your controller route
        ]
    ])->label('District') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'ward_id')->widget(DepDrop::class, [
            'pluginOptions' => [
                'depends' => ['customer-province_id', 'district_id'],
                'placeholder' => 'Select ward',
                'url' => Url::to(['/customer/get-wards']) // change this to match your controller route
            ]
        ]) ?>
    </div>
</div>


    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

<!--    --><?php //= $form->field($model, 'updated_at')->textInput() ?>

<!--    --><?php //= $form->field($model, 'created_by')->textInput() ?>

<!--    --><?php //= $form->field($model, 'is_deleted')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

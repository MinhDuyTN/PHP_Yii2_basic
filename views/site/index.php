<?php

/** @var yii\web\View $this */

use app\models\LoginForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/** @var $model LoginForm */

$this->title = 'My Yii Application';
?>




<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Welcome to the website!</h1>

        <p class="lead">Still not registered?</p>

        <p><a class="btn btn-lg btn-success" href="<?= \yii\helpers\Url::to(['site/register']) ?>">Register now</a></p>
    </div>

    <div class="body-content">

        <div class="login-form">

            <h2>Login</h2>
            <?php $form = ActiveForm::begin(); ?>
            <?php echo Yii::$app->security->generatePasswordHash('admin123'); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div class="form-group">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>

    </div>
</div>
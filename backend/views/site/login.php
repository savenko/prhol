<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\authclient\widgets\AuthChoice;
use frontend\widgets\RegistrationAddCompanyForm;

?>
    <div class="login-box">
        <div class="login-logo">
            <a href="/"><b>Test</b>Site</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Пожалуйста, авторизируйтесь</p>

            <?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => ['autocomplete' => 'off']]); ?>
            <?= $form->field($model, 'username', [
                    'template' => "{input}<span class=\"glyphicon glyphicon-user form-control-feedback\"></span>\n{hint}\n{error}",
                    'options' => ['class' => 'form-group has-feedback'],
                ]
            )
                ->textInput(['placeholder' => 'Имя пользователя'])
            ?>

            <?= $form->field($model, 'password', [
                    'template' => "{input}<span class=\"glyphicon glyphicon-lock form-control-feedback\"></span>\n{hint}\n{error}",
                    'options' => ['class' => 'form-group has-feedback'],
                ]
            )
                ->passwordInput(['placeholder' => 'Пароль'])
            ?>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <?= $form->field($model, 'rememberMe')->checkbox(['class' => 'minimal']) ?>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <?php echo Html::submitButton('Войти', ['class' => 'btn btn-primary btn-block btn-flat']); ?>
                </div>
                <!-- /.col -->
            </div>
            <?php ActiveForm::end(); ?>

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
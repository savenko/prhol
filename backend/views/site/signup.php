<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\authclient\widgets\AuthChoice;
?>
<div class="register-box">
    <div class="register-logo">
        <a href="/"><b>Test</b>Site</a>
    </div>

    <div class="register-box-body">
        <p class="login-box-msg">Регистрация администратора</p>
        <?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => ['autocomplete' => 'off']]); ?>

        <?= $form->field($model, 'username', [
                'template'=>"{input}<span class=\"glyphicon glyphicon-user form-control-feedback\"></span>\n{hint}\n{error}",
                'options'=>['class'=>'form-group has-feedback'],
            ]
        )
            ->textInput(['placeholder'=>'Имя пользователя'])
        ?>

        <?= $form->field($model, 'email', [
                'template'=>"{input}<span class=\"glyphicon glyphicon-envelope form-control-feedback\"></span>\n{hint}\n{error}",
                'options'=>['class'=>'form-group has-feedback'],
            ]
        )
            ->textInput(['placeholder'=>'Email'])
        ?>
        <?= $form->field($model, 'password', [
                'template'=>"{input}<span class=\"glyphicon glyphicon-lock form-control-feedback\"></span>\n{hint}\n{error}",
                'options'=>['class'=>'form-group has-feedback'],
            ]
        )
            ->passwordInput(['placeholder'=>'Пароль'])
        ?>
        <?= $form->field($model, 'password2', [
                'template'=>"{input}<span class=\"glyphicon glyphicon-log-in form-control-feedback\"></span>\n{hint}\n{error}",
                'options'=>['class'=>'form-group has-feedback'],
            ]
        )
            ->passwordInput(['placeholder'=>'Повторите пароль'])
        ?>
        <div class="row">
            <div class="col-xs-offset-5 col-xs-7">
                <?php echo Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary btn-block btn-flat']); ?>
            </div><!-- /.col -->
        </div>

        <?php ActiveForm::end(); ?>
    </div><!-- /.form-box -->
</div><!-- /.register-box -->
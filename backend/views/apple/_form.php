<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Apple */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-default">
            <div class="box-header">
                <h3 class="box-title">Форма</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            <?php $form = ActiveForm::begin(); ?>
            <div class="box-body">
                    <?= $form->field($model, 'color')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'fall_at')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ 'hanging' => 'Hanging', 'fall' => 'Fall', 'rotten' => 'Rotten', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'size')->textInput(['maxlength' => true]) ?>

            </div>
            <div class="box-footer">
                <?= Html::submitButton($model->isNewRecord ? 'Добавить'                : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' :
                'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>

<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
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

            <?= "<?php " ?>$form = ActiveForm::begin(); ?>
            <div class="box-body">
                <?php foreach ($generator->getColumnNames() as $attribute) {
                    if (in_array($attribute, $safeAttributes)) {
                        echo "    <?= " . $generator->generateActiveField($attribute) . " ?>\n\n";
                    }
                } ?>
            </div>
            <div class="box-footer">
                <?= "<?= " ?>Html::submitButton($model->isNewRecord ? <?= $generator->generateString('Добавить') ?>
                : <?= $generator->generateString('Обновить') ?>, ['class' => $model->isNewRecord ? 'btn btn-success' :
                'btn btn-primary']) ?>
            </div>

            <?= "<?php " ?>ActiveForm::end(); ?>

        </div>
    </div>
</div>

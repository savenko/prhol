<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Apple */

$this->title = 'Добавить Apple';
$this->params['breadcrumbs'][] = ['label' => 'Apples', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apple-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

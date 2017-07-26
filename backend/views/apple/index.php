<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use \common\models\Apple;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AppleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Яблоки';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Таблица</h3>
                <div class="box-tools">
                    <?php
                    Modal::begin([
                        'header' => '<h2>Генерация яблок</h2>',
                        'toggleButton' => ['label' => 'Сгенерировать яблоки', 'class' => 'btn btn-primary btn-sm'],
                        'footer' => Html::submitButton('Сгенерировать', ['onclick' => '$("#apple-generate-form").submit()', 'class' => 'btn btn-primary']),
                    ]);

                    $form = ActiveForm::begin(['action' => ['apple/generate'], 'id' => 'apple-generate-form']);
                    echo $form->field($appleGenerateForm, 'quantity')->textInput();
                    ActiveForm::end();

                    Modal::end();
                    ?>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="example2_wrapper" class="dataTables_wrapper form-inline" role="grid">
                    <div class="row">
                        <div class="col-xs-6"></div>
                        <div class="col-xs-6"></div>
                    </div>
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?php
                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            ['attribute' => 'color', 'value' => function ($data) {
                                return "<div class='box_color' style='background-color: " . Html::encode($data->color) . "'></div> " . Html::encode($data->color);
                            }, 'format' => 'raw'],
                            [
                                'attribute' => 'created_at',
                                'format' => 'html',
                                'filterType' => GridView::FILTER_DATE,
                                'value' => function ($data) {
                                    if ($data->created_at) {
                                        return date('d.m.Y H:i:s', $data->created_at);
                                    }
                                }
                            ],
                            [
                                'attribute' => 'fall_at',
                                'format' => 'html',
                                'filterType' => GridView::FILTER_DATE,
                                'value' => function ($data) {
                                    if ($data->fall_at) {
                                        return date('d.m.Y H:i:s', $data->fall_at);
                                    }
                                }
                            ],
                            ['attribute' => 'status', 'value' => function ($data) {
                                return Apple::$statusArr[$data->status];
                            }, 'filter' => Apple::$statusArr],
                            [
                                'class' => 'kartik\grid\EditableColumn',
                                'attribute' => 'size',
                                'refreshGrid' => true,
                                'editableOptions' => [
                                    'header' => 'Установите значение в процентах',
                                    'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                                    'formOptions' => ['action' => ['change-size']],
                                    'resetDelay' => 0,
                                    'options' => ['value' => '']
                                ],
                            ],
                            ['class' => 'yii\grid\ActionColumn',
                                'template' => '{fall-to-ground}  {delete}',
                                'buttons' => [
                                    'fall-to-ground' => function ($url, $model) {
                                        if ($model->status == "hanging") {
                                            return \yii\helpers\Html::a('<span class="glyphicon glyphicon-arrow-down"></span>', $url,
                                                ['title' => 'Упасть', 'data-pjax' => '0', 'class' => 'btn btn-default btn-sm']);
                                        }
                                    },
                                    'delete' => function ($url, $model) {
                                        if ($model->size==0) {
                                            return \yii\helpers\Html::a('<span class="glyphicon glyphicon-trash"></span>', $url,
                                                ['title' => 'Удалить', 'data-pjax' => '0', 'class' => 'btn btn-default btn-sm']);
                                        }
                                    }
                                ],
                            ],
//                            ['attribute' => 'status', 'value' => function($data){
//                                return Apple::$statusArr[$data->status];
//                            },'filter'=>Apple::$statusArr],
                            // 'size',
                        ],
                        'layout' => "{items}
                    <div class='dt-row dt-bottom-row'>
                        <div class='row'>
                            <div class='col-sm-6'>
                                {summary}
                            </div>
                            <div class='col-sm-6 text-right'>
                                {pager}
                            </div>
                        </div></div>"
                    ]);
                    ?>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <!-- /.col -->
    </div>

</div>

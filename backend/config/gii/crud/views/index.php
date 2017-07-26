<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\Pjax;
use <?= $generator->indexWidgetType === 'grid' ? "yii\\grid\\GridView" : "yii\\widgets\\ListView" ?>;

/* @var $this yii\web\View */
<?= !empty($generator->searchModelClass) ? "/* @var \$searchModel " . ltrim($generator->searchModelClass, '\\') . " */\n" : '' ?>
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Таблица</h3>
                <div class="box-tools">
                    <?php echo "<?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success btn-sm']) ?>" ?>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="example2_wrapper" class="dataTables_wrapper form-inline" role="grid">
                    <div class="row">
                        <div class="col-xs-6"></div>
                        <div class="col-xs-6"></div>
                    </div>
<?php if(!empty($generator->searchModelClass)): ?>
<?= "    <?php " . ($generator->indexWidgetType === 'grid' ? "// " : "") ?>echo $this->render('_search', ['model' => $searchModel]); ?>
<?php endif; ?>

<?php if ($generator->indexWidgetType === 'grid'): ?>
    <?= "<?php " ?>
    Pjax::begin();
   echo GridView::widget([
        'dataProvider' => $dataProvider,
        <?= !empty($generator->searchModelClass) ? "'filterModel' => \$searchModel,\n        'columns' => [\n" : "'columns' => [\n"; ?>
            ['class' => 'yii\grid\SerialColumn'],

<?php
$count = 0;
if (($tableSchema = $generator->getTableSchema()) === false) {
    foreach ($generator->getColumnNames() as $name) {
        if (++$count < 6) {
            echo "            '" . $name . "',\n";
        } else {
            echo "            // '" . $name . "',\n";
        }
    }
} else {
    foreach ($tableSchema->columns as $column) {
        $format = $generator->generateColumnFormat($column);
        if (++$count < 6) {
            echo "            '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
        } else {
            echo "            // '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
        }
    }
}
?>

                    [   'class' => 'yii\grid\ActionColumn',
                    'template'=>'{update}  {delete}',
                    'buttons'=>[
                    'update'=>function ($url, $model) {
                    return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-pencil"></span>', $url,
                    ['title' => 'Обновить', 'data-pjax' => '0','class'=>'btn btn-default btn-sm']);
                    },
                    'delete'=>function ($url, $model) {
                    return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-trash"></span>', $url,
                    ['title' =>  'Удалить', 'data-pjax' => '0','class'=>'btn btn-default btn-sm']);
                    }
                    ],
                    ],
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
                    Pjax::end();
                    ?>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    <!-- /.col -->
</div>
<?php else: ?>
    <?= "<?= " ?>ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model-><?= $nameAttribute ?>), ['view', <?= $urlParams ?>]);
        },
    ]) ?>
<?php endif; ?>

</div>

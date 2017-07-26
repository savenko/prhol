<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use backend\widgets\Alert;
use backend\widgets\Header;
use backend\widgets\SideBar;
use backend\widgets\Footer;
use backend\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <!--
    This is a starter template page. Use this page to start your new project from
    scratch. This page gets rid of all links and provides the needed markup only.
    -->
    <html>
    <head>
        <meta charset="UTF-8">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <!-- Main Header -->
        <?= Header::widget() ?>
        <!-- Left side column. contains the logo and sidebar -->
        <?= SideBar::widget() ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <?= $this->params['titleTag']??$this->title ?>
                </h1>
                <?= Breadcrumbs::widget([
                    'tag'=>'ol',
                    'homeLink'=>['url'=>'/my','label'=>'<i class="fa fa-dashboard"></i> Панель управления'],
                    'encodeLabels'=>false,
                    'links'=>isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []
                ]) ?>
            </section>

            <!-- Main content -->
            <section class="content">
                <?= Alert::widget() ?>
                <?= $content ?>
            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->
        <!-- Main Footer -->
        <?= Footer::widget() ?>

    </div><!-- ./wrapper -->

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
          Both of these plugins are recommended to enhance the
          user experience -->
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>
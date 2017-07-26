<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/theme/AdminLTE.min.css',
        'css/theme/skin-blue.min.css',
        'js/iCheck/square/blue.css',
        'css/site.css',
    ];
    public $js = [
        'js/iCheck/icheck.min.js',
        'js/adminlte.min.js',
        'js/site.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'backend\assets\FontAwesomeAsset',
        'backend\assets\IeAsset',
    ];
}

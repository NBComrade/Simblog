<?php

namespace app\assets;

use yii\web\AssetBundle;

class SimblogAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "css/simblog.min.css",
    ];
    public $js = [
        'js/simblog.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}

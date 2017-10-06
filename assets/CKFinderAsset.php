<?php
namespace app\assets;

use yii\web\AssetBundle;

class CKFinderAsset extends AssetBundle
{
    public $sourcePath = '@bower/ckfinder';

    public $js = [
        'ckfinder.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
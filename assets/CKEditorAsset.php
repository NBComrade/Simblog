<?php
namespace app\assets;

use yii\web\AssetBundle;

class CKEditorAsset extends AssetBundle
{
    public $sourcePath = '@bower/ckeditor';

    public $js = [
        'ckeditor.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
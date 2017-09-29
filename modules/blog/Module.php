<?php
namespace app\modules\blog;
use Yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\blog\controllers';
    public $layout = '@app/modules/blog/views/layout/main';
    public function init()
    {
        parent::init();
    }

    public function behaviors()
    {
        return parent::behaviors();
    }

}
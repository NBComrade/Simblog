<?php

namespace app\modules\blog\widgets;

use app\repositories\CategoryRepository;
use Yii;
use yii\base\Widget;

class CategoriesWidget extends Widget
{
    private $categories;

    public function init()
    {
        parent::init();
        if (!Yii::$app->cache->exists('categories')) {
            $this->categories = CategoryRepository::getAll();
            Yii::$app->cache->set('categories', $this->categories, 180);
        } else {
            $this->categories = Yii::$app->cache->get('categories');
        }
    }
    public function run()
    {
        return $this->render('categories', ['categories' => $this->categories]);
    }
}
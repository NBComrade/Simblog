<?php

namespace app\modules\blog\widgets;

use app\repositories\CategoryRepository;
use yii\base\Widget;

class CategoriesWidget extends Widget
{
    private $categories;

    public function init()
    {
        parent::init();
        if (!$this->categories) {
            $this->categories = CategoryRepository::getAll();
        }
    }
    public function run()
    {
        return $this->render('categories', ['categories' => $this->categories]);
    }
}
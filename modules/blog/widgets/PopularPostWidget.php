<?php
namespace app\modules\blog\widgets;

use app\repositories\ArticleRepository;
use yii\base\Widget;

class PopularPostWidget extends Widget
{
    private $popularPosts;

    public function init()
    {
        parent::init();
        if (!$this->popularPosts) {
            $this->popularPosts = ArticleRepository::getPopular();
        }

    }
    public function run()
    {
        return $this->render('popular', ['popularPosts' => $this->popularPosts]);
    }
}
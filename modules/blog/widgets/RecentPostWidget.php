<?php

namespace app\modules\blog\widgets;

use app\repositories\ArticleRepository;
use yii\base\Widget;


class RecentPostWidget extends Widget
{
    private $recentPosts;

    public function init()
    {
        parent::init();
        if (!$this->recentPosts) {
            $this->recentPosts = ArticleRepository::getLast();
        }
    }
    public function run()
    {
        return $this->render('recent', ['recentPosts' => $this->recentPosts]);
    }
}
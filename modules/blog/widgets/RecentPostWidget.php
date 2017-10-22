<?php

namespace app\modules\blog\widgets;

use app\repositories\ArticleRepository;
use Yii;
use yii\base\Widget;


class RecentPostWidget extends Widget
{
    private $recentPosts;

    public function init()
    {
        parent::init();
        if (!Yii::$app->cache->exists('recent')) {
            $this->recentPosts = ArticleRepository::getLast();
            Yii::$app->cache->set('recent', $this->recentPosts, 180);
        } else {
            $this->recentPosts = Yii::$app->cache->get('recent');
        }
    }
    public function run()
    {
        return $this->render('recent', ['recentPosts' => $this->recentPosts]);
    }
}
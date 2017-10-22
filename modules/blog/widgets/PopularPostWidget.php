<?php
namespace app\modules\blog\widgets;

use app\repositories\ArticleRepository;
use Yii;
use yii\base\Widget;

class PopularPostWidget extends Widget
{
    private $popularPosts;

    public function init()
    {
        parent::init();
        if (!Yii::$app->cache->exists('popular')) {
            $this->popularPosts = ArticleRepository::getPopular();
            Yii::$app->cache->set('popular', $this->popularPosts, 180);
        } else {
            $this->popularPosts = Yii::$app->cache->get('popular');
        }

    }
    public function run()
    {
        return $this->render('popular', ['popularPosts' => $this->popularPosts]);
    }
}
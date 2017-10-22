<?php
namespace app\modules\blog\widgets;

use app\repositories\ArticleRepository;
use yii\base\Widget;
use yii\helpers\Html;

class PopularPostWidget extends Widget
{
    private $popularPosts;

    public function init()
    {
        parent::init();
        $this->popularPosts = ArticleRepository::getPopular();
        if (!$this->popularPosts) {

        }

    }
    public function run()
    {
        return $this->render('popular', ['popularPosts' => $this->popularPosts]);
    }
}
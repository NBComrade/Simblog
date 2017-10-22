<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\blog\widgets\PopularPostWidget;
?>
<div class="primary-sidebar">
    <?= PopularPostWidget::widget() ?>
    <aside class="widget pos-padding">
        <h3 class="widget-title text-uppercase text-center">Recent Posts</h3>
        <?php foreach($last as $item):?>
            <div class="thumb-latest-posts">
                <div class="media">
                    <div class="media-left">
                        <a href="<?=Url::toRoute(['site/view', 'id' => $item->id])?>" class="popular-img">
                            <?= Html::img(Yii::$app->urlManager->createUrl($item->getImage())) ?>
                            <div class="p-overlay"></div>
                        </a>
                    </div>
                    <div class="p-content">
                        <a href="<?=Url::toRoute(['site/view', 'id' => $item->id])?>" class="text-uppercase"><?=$item->title;?></a>
                        <span class="p-date"><?=$item->getDate();?></span>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    </aside>
    <aside class="widget border pos-padding">
        <h3 class="widget-title text-uppercase text-center">Categories</h3>
        <ul>
            <?php foreach($categories as $category):?>
                <li>
                    <a href="<?=Url::toRoute(['site/category', 'id' => $category->id])?>"><?=$category->title;?></a>
                    <span class="post-count pull-right"> (<?=$category->getArticlesCount();?>)</span>
                </li>
            <?php endforeach;?>
        </ul>
    </aside>
</div>
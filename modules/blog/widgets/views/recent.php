<?php
use yii\helpers\Url;
use yii\helpers\Html;

?>
<aside class="widget pos-padding">
    <h3 class="widget-title text-uppercase text-center">Recent Posts</h3>
    <?php foreach($recentPosts as $item):?>
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
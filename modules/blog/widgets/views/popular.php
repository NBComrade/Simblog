<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>
<aside class="widget">
    <h3 class="widget-title text-uppercase text-center">Popular Posts</h3>
    <?php foreach($popularPosts as $post):?>
        <div class="popular-post">
            <a href="<?=Url::toRoute(['site/view', 'id' => $post->id])?>" class="popular-img">
                <?= Html::img(Yii::$app->urlManager->createUrl($post->getImage())) ?>
                <div class="p-overlay"></div>
            </a>
            <div class="p-content">
                <a href="<?=Url::toRoute(['site/view', 'id' => $post->id])?>" class="text-uppercase"><?= $post->title;?></a>
                <span class="p-date"><?= $post->getDate();?></span>
            </div>
        </div>
    <?php endforeach;?>
</aside>

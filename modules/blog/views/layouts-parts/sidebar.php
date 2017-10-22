<?php
use yii\helpers\Url;
use app\modules\blog\widgets\PopularPostWidget;
use app\modules\blog\widgets\RecentPostWidget;
?>
<div class="primary-sidebar">
    <?= PopularPostWidget::widget() ?>
    <?= RecentPostWidget::widget() ?>
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
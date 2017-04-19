<?php
    use yii\helpers\Url;
?>
<div class="primary-sidebar">

    <aside class="widget">
        <h3 class="widget-title text-uppercase text-center">Popular Posts</h3>
        <?php foreach($popular as $post):?>
            <div class="popular-post">
                <a href="<?=Url::toRoute(['site/view', 'id' => $post->id])?>" class="popular-img"><img src="<?=$post->getImage();?>" alt="">
                    <div class="p-overlay"></div>
                </a>
                <div class="p-content">
                    <a href="<?=Url::toRoute(['site/view', 'id' => $post->id])?>" class="text-uppercase"><?= $post->title;?></a>
                    <span class="p-date"><?= $post->getDate();?></span>
                </div>
            </div>
        <?php endforeach;?>

    </aside>
    <aside class="widget pos-padding">
        <h3 class="widget-title text-uppercase text-center">Recent Posts</h3>
        <?php foreach($last as $item):?>
            <div class="thumb-latest-posts">
                <div class="media">
                    <div class="media-left">
                        <a href="<?=Url::toRoute(['site/view', 'id' => $item->id])?>" class="popular-img"><img  src="<?=$item->getImage();?>" alt="">
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
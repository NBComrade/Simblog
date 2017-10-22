<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>
<!--main content start-->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php foreach($article as $post):?>
                <article class="post post-list">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="post-thumb">
                                <a href="<?=Url::toRoute(['site/view', 'id' => $post->id])?>">
                                    <?= Html::img(Yii::$app->urlManager->createUrl($post->getImage())) ?>
                                </a>

                                <a href="<?=Url::toRoute(['site/view', 'id' => $post->id])?>" class="post-thumb-overlay text-center">
                                    <div class="text-uppercase text-center">View Post</div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="post-content">
                                <header class="entry-header text-uppercase">
                                    <h6><a href="<?=Url::toRoute(['site/category', 'id' => $post->category->id])?>"> <?=$post->category->title;?></a></h6>

                                    <h1 class="entry-title"><a href="<?=Url::toRoute(['site/view', 'id' => $post->id])?>"><?=$post->title;?></a></h1>
                                </header>
                                <div class="entry-content">
                                    <p><?=$post->description;?>
                                    </p>
                                </div>
                                <div class="social-share">
                                    <span class="social-share-title pull-left text-capitalize">By Rubel On <?=$post->getDate();?></span>

                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                <?php endforeach; ?>
                <?php
                echo \yii\widgets\LinkPager::widget([
                    'pagination' => $pagination,
                ])
                ?>
            </div>
            <div class="col-md-4" data-sticky_column>
                <?=$this->render('/layouts-parts/sidebar', [
                    'popular' => $popular,
                    'last' => $last,
                    'categories' => $categories
                ])?>
            </div>
        </div>
    </div>
</div>
<!-- end main content-->
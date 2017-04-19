<?php
use yii\helpers\Url;
$this->title = $article->title;
?>
<!--main content start-->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <article class="post">
                    <div class="post-thumb">
                       <img src=" <?=$article->getImage();?>" alt="">
                    </div>
                    <div class="post-content">
                        <header class="entry-header text-center text-uppercase">
                            <h6><a href="<?=Url::toRoute(['site/category', 'id' => $article->category->id])?>"><?=$article->category->title;?></a></h6>

                            <h1 class="entry-title"><a href="blog.html"><?=$article->title;?></a></h1>


                        </header>
                        <div class="entry-content">
                            <?=$article->content;?>
                        </div>
                        <div class="decoration">
                            <?php foreach($tags as $tag):?>
                                <a href="#" class="btn btn-default"><?=$tag->title;?></a>
                            <?php endforeach;?>
                        </div>

                        <div class="social-share">
							<span
                                class="social-share-title pull-left text-capitalize"><?php if(!empty($user)):?>By <?=$user->name;?><?php endif; ?> On <?=$article->getDate();?></span>
                            <ul class="text-center pull-right">
                                <li><a class="s-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a class="s-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a class="s-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a class="s-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a class="s-instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </article>
                <?php if(!empty($user)):?>
                <div class="top-comment"><!--top comment-->
                    <img src="<?=$user->photo;?> " class="pull-left img-circle" alt="">
                    <h4><?=$user->name;?> </h4>

                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy hello ro mod tempor
                        invidunt ut labore et dolore magna aliquyam erat.</p>
                </div><!--top comment end-->
                <?php endif;?>
                <div class="related-post-carousel"><!--related post carousel-->
                    <div class="related-heading">
                        <h4>You might also like</h4>
                    </div>
                    <div class="items">
                        <?php foreach($categoryArticles as $article): ?>
                        <div class="single-item">
                            <a href="<?=Url::toRoute(['site/view', 'id' => $article->id])?>">
                                <img width="230px" src="<?=$article->getImage();?>" alt="">
                                <p style="text-transform: uppercase;"><?=$article->title; ?></p>
                            </a>
                        </div>
                        <?php endforeach;?>
                    </div>
                </div><!--related post carousel-->
                <?php if(!empty($comments)):?>
                    <?php ?>
                    <?php  foreach($comments as $comment): ?>
                        <div class="bottom-comment"><!--bottom comment-->
                            <h4>3 comments</h4>

                            <div class="comment-img">
                                <img class="img-circle" src="<?= $comment->user->image;?>" alt="">
                            </div>

                            <div class="comment-text">
                                <a href="#" class="replay btn pull-right"> Replay</a>
                                <h5><?= $comment->user->name;?></h5>

                                <p class="comment-date">
                                    <?= $comment->getDate();?>
                                </p>


                                <p class="para"><?= $comment->text;?></p>
                            </div>
                        </div>
                    <?php  endforeach; ?>
                <?php endif;?>
                <?php if(!Yii::$app->user->isGuest):?>
                    <div class="leave-comment">
                    <h4>Leave a reply</h4>
                    <?php if(Yii::$app->session->hasFlash('comment')):?>
                        <div class="alert alert-success">
                            <?= Yii::$app->session->getFlash('comment')?>
                        </div>
                    <?php endif;?>
                    <?php $form = \yii\widgets\ActiveForm::begin([
                        'action'=> ['site/comment', 'id' => $article->id],
                        'options' => ['class'=> 'form-horizontal contact-form', 'role'=>'form']
                    ])?>
                    <div class="form-group">
                        <div class="col-md-12">
                            <?= $form->field($commentForm, 'comment')->textarea(['class'=>'form-control','placeholder'=>'Write Message'])->label(false)?>
                        </div>
                    </div>
                    <button type="submit" class="btn send-btn">Post Comment</button>
                    <?php \yii\widgets\ActiveForm::end()?>
                </div><!--end leave comment-->
                <?php endif;?>
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
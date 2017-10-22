<?php
use app\modules\blog\widgets\PopularPostWidget;
use app\modules\blog\widgets\RecentPostWidget;
use app\modules\blog\widgets\CategoriesWidget;
?>
<div class="primary-sidebar">
    <?= PopularPostWidget::widget() ?>
    <?= RecentPostWidget::widget() ?>
    <?= CategoriesWidget::widget() ?>
</div>
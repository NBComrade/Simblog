<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\SimblogAsset;

SimblogAsset::register($this);
$this->title = "Simblog";
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?=$this->render('/layouts-parts/header')?>
<?=$content;?>
<?=$this->render('/layouts-parts/footer')?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

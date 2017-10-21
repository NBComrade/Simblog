<?php

namespace app\repositories;

use app\models\Article;
use app\models\Tag;

class TagRepository extends Tag
{
    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['id' => 'article_id'])
            ->viaTable('article_tag', ['tag_id' => 'id']);
    }
}
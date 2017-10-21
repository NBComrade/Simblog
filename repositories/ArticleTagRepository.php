<?php

namespace app\repositories;


use app\models\Article;
use app\models\ArticleTag;
use app\models\Tag;

class ArticleTagRepository extends ArticleTag
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tag_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['id' => 'article_id']);
    }
}
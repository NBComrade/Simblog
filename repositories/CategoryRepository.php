<?php

namespace app\repositories;

use yii\data\Pagination;
use app\models\Category;

class CategoryRepository extends Category
{
    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['category_id'=> 'id']);
    }
    public function getArticlesCount()
    {
        return $this->getArticles()->count();
    }
    public static function getAll(){
        return self::find()->all();
    }
    public static function getArticlesByCategory(int $id, int $pageSize = 3){
        $query = Article::find()->where(['category_id' => $id]);

        $count = $query->count();

        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);

        $articles = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        $data['articles'] = $articles;
        $data['pagination'] =$pagination;
        return $data;
    }
    public static function getArticlesByCategoryId($id)
    {
        return Article::find()->where(['category_id' => $id])->all();
    }
    public static function getCategoryIdByArticleId($id)
    {
        $article = Article::findOne(['id' => $id]);
        return $article->category_id;
    }
}
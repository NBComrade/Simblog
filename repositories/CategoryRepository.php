<?php

namespace app\repositories;

use app\models\Article;
use yii\data\Pagination;
use app\models\Category;

class CategoryRepository extends Category
{
    /**
     * @return int|string
     */
    public function getArticlesCount() : int
    {
        return $this->getArticles()->count();
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getAll(){
        return self::find()->all();
    }

    /**
     * Get articles of particular category with pagination
     * @param int $id
     * @param int $pageSize
     * @return mixed
     */
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

    /**
     * @param $id
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getArticlesByCategoryId($id)
    {
        return Article::find()->where(['category_id' => $id])->all();
    }
    /**
     * @param $id
     * @return int
     */
    public static function getCategoryIdByArticleId(int $id)
    {
        $article = Article::findOne(['id' => $id]);
        return $article->category_id;
    }

}
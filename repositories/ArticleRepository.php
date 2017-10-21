<?php

namespace app\repositories;

use app\behaviors\DateBehavior;
use app\models\ArticleTag;
use app\models\Category;
use app\models\Comment;
use app\models\Tag;
use app\models\User;
use Yii;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use app\modules\admin\components\ImageUpload;
use app\models\Article;

class ArticleRepository extends Article
{
    const POPULAR_COUNT = 3;
    const LAST_COUNT = 4;



    /**
     * @return bool
     */
    public function beforeDelete()
    {
        $this->deleteImage();
        return parent::beforeDelete();
    }

    /**
     * @param string $ImageName
     * @return bool
     */
    public function saveImage(string $ImageName)
    {
        $this->image = $ImageName;
        return $this->save(false);
    }

    /**
     * @return void
     */
    public function deleteImage() : void
    {
        $imageModel = new ImageUpload();
        $imageModel->deleteCurrentImage($this->image);

    }

    /**
     * @param $category
     * @return bool
     */
    public function saveCategory($category)
    {
        $this->category_id = $category;
        return $this->save(false);
    }

    /**
     * @return bool
     */
    public function checkAndSaveCategory() : bool
    {
        $category = Yii::$app->request->post('category');
        if ($this->saveCategory($category)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return array
     */
    public function getArticleTags() : array
    {
        $tags = [];
        $tagId = $this->getSelectedTags();
        foreach($tagId as $id){
            $tags[] = Tag::find()->where(['id' => $id])->one();
        }
        return $tags;
    }

    /**
     * @return array
     */
    public function getSelectedTags() : array
    {
        $selectedTags = $this->getTags()->select('id')->asArray()->all();
        return ArrayHelper::getColumn($selectedTags, 'id');
    }

    /**
     * @param $tags
     * @return bool
     */
    public function saveTags(array $tags) : bool
    {
        if (is_array($tags)) {
            ArticleTag::deleteAll(['article_id' => $this->id]);
            foreach ($tags as $tag_id) {
                $tag = Tag::findOne($tag_id);
                $this->link('tags', $tag);
            }
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function checkAndSaveTags() : bool
    {
        $tags = Yii::$app->request->post('tags');
        if ($this->saveTags($tags)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get all articles with pagination;
     * @param int $pageSize
     * @return array
     */
    public static function getAll(int $pageSize = 5)
    {
        $query = Article::find();

        $count = $query->count();

        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);

        $articles = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        $data['articles'] = $articles;
        $data['pagination'] = $pagination;
        return $data;
    }

    /**
     * @return array
     */
    public static function getPopular() : array
    {
        return self::find()->orderBy('viewed desc')->limit(self::POPULAR_COUNT)->all();
    }

    /**
     * @return array
     */
    public static function getLast() : array
    {
        return self::find()->orderBy('date desc')->limit(self::LAST_COUNT)->all();
    }

    /**
     * @return bool
     */
    public function saveArticle() : bool
    {
        $this->user_id = Yii::$app->user->id;
        return $this->save();
    }


    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getArticleComments()
    {
        return $this->getComments()->where(['status' => 1])->all();
    }


    /**
     * @return array
     */
    public function getArticleAuthor()
    {
        return $this->getUser()->where(['id' => $this->user_id])->one();
    }

    /**
     * Add one new view
     * @return bool
     */
    public function viewedCounter() : bool
    {
        $this->viewed += 1;
        return $this->save(false);
    }

    /**
     * @return array
     */
    public static function getRandomPost() : array
    {
        return Article::find()->orderBy('RAND()')->limit(1)->all();
    }
}
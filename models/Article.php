<?php

namespace app\models;

use Yii;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $content
 * @property string $date
 * @property string $image
 * @property integer $viewed
 * @property integer $user_id
 * @property integer $status
 * @property integer $category_id
 *
 * @property ArticleTag[] $articleTags
 * @property Comment[] $comments
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title', 'description', 'content'], 'string'],
            [['date'], 'date', 'format' => 'php:Y-m-d'],
            [['date'], 'default', 'value' => date('Y-m-d')],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'content' => 'Content',
            'date' => 'Date',
            'image' => 'Image',
            'viewed' => 'Viewed',
            'user_id' => 'User ID',
            'status' => 'Status',
            'category_id' => 'Category ID',
        ];
    }

    public function saveImage($ImageName)
    {
        $this->image = $ImageName;
        return $this->save(false);
    }

    public function deleteImage()
    {
        $imageModel = new ImageUpload();
        $imageModel->deleteCurrentImage($this->image);

    }

    public function getImage()
    {
        if ($this->image) {
            return '/uploads/' . $this->image;
        } else {
            return '/no-image.jpg';
        }
    }

    public function beforeDelete()
    {
        $this->deleteImage();
        return parent::beforeDelete();
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function saveCategory($category)
    {
        $this->category_id = $category;
        return $this->save(false);
    }

    public function checkAndSaveCategory()
    {
        $category = Yii::$app->request->post('category');
        if ($this->saveCategory($category)) {
            return true;
        } else {
            return false;
        }
    }

    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])
            ->viaTable('article_tag', ['article_id' => 'id']);
    }
    public function getArticleTags()
    {
        $tags = [];
        $tagId = $this->getSelectedTags();
        foreach($tagId as $id){
            $tags[] = Tag::find()->where(['id' => $id])->one();
        }
        return $tags;
    }
    public function getSelectedTags()
    {
        $selectedTags = $this->getTags()->select('id')->asArray()->all();
        return ArrayHelper::getColumn($selectedTags, 'id');
    }

    public function saveTags($tags)
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

    public function checkAndSaveTags()
    {
        $tags = Yii::$app->request->post('tags');
        if ($this->saveTags($tags)) {
            return true;
        } else {
            return false;
        }
    }

    public function getDate()
    {
        return Yii::$app->formatter->asDate($this->date);
    }

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

    public static function getPopular()
    {
        return self::find()->orderBy('viewed desc')->limit(3)->all();
    }

    public static function getLast()
    {
        return self::find()->orderBy('date desc')->limit(4)->all();
    }

    public function saveArticle()
    {
        $this->user_id = Yii::$app->user->id;
        return $this->save();
    }

    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['article_id' => 'id']);
    }
    public function getArticleComments()
    {
        return $this->getComments()->where(['status' => 1])->all();
    }
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    public function getArticleAuthor()
    {
        return $this->getUser()->where(['id' => $this->user_id])->one();
    }
    public function viewedCounter()
    {
        $this->viewed += 1;
        return $this->save(false);
    }
    public static function getRandomPost()
    {
        return Article::find()->orderBy('RAND()')->limit(1)->all();
    }
}

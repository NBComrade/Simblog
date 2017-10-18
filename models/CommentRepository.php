<?php

namespace app\models;

use Yii;

class CommentRepository extends Comment
{
    /**
     * @inheritdoc
     */
    const STATUS_DISALLOW = 0;
    const STATUS_ALLOW =1;

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['id' => 'article_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    public function getDate()
    {
        return Yii::$app->formatter->asDate($this->date);
    }
    public function isAllowed()
    {
        return $this->status;
    }
    public function allow()
    {
        $this->status = self::STATUS_ALLOW;
        return $this->save(false);
    }
    public function disallow()
    {
        $this->status = self::STATUS_DISALLOW;;
        return $this->save(false);
    }

}
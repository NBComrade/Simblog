<?php

namespace app\repositories;


use app\models\Comment;
use app\modules\blog\forms\CommentForm;
use DomainException;
use Yii;

class CommentRepository extends Comment
{
    /**
     * @inheritdoc
     */
    const STATUS_DISALLOW = 0;
    const STATUS_ALLOW =1;

    /**
     * @return int
     */
    public function isAllowed() : int
    {
        return $this->status;
    }
    /**
     * @return bool
     */
    public function allow() : bool
    {
        $this->status = self::STATUS_ALLOW;
        return $this->save(false);
    }

    /**
     * @return bool
     */
    public function disallow() : bool
    {
        $this->status = self::STATUS_DISALLOW;;
        return $this->save(false);
    }

    /**
     * Save new Comment by article ID
     * @param CommentForm $model
     * @param $articleId
     */
    public static function saveNewComment(CommentForm $model, int $articleId){
        $comment = new Comment();
        $comment->text = $model->comment;
        $comment->user_id = Yii::$app->user->id;
        $comment->article_id = $articleId;
        $comment->status = self::STATUS_DISALLOW;
        $comment->date =date('Y-m-d');
        if (!$comment->save()) {
            throw new DomainException(sprintf("Can not save new comment for article %s", $articleId));
        }
    }

}
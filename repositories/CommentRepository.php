<?php

namespace app\repositories;

use app\models\Article;
use app\models\Comment;
use app\models\User;
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

}
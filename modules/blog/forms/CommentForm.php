<?php
namespace app\modules\blog\forms;
use app\models\Comment;
use yii\base\Model;
use Yii;

class CommentForm extends Model
{
    public $comment;

    public function rules()
    {
        return [
          [['comment'], 'required'],
            [['comment'],'string' ,'max' => 255]
        ];
    }

    public function saveComment(int $article_id)
    {
        $comment = new Comment();
        $comment->text = $this->comment;
        $comment->user_id = Yii::$app->user->id;
        $comment->article_id = $article_id;
        $comment->status = 0;
        $comment->date =date('Y-m-d');
        $comment->save();
    }
}
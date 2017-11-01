<?php
namespace app\modules\blog\forms;

use yii\base\Model;

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
}
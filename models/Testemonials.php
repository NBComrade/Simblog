<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "testemonials".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $author
 * @property string $photo
 */
class Testemonials extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'testemonials';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['title', 'author', 'photo'], 'string', 'max' => 255],
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
            'content' => 'Content',
            'author' => 'Author',
            'photo' => 'Photo',
        ];
    }
}

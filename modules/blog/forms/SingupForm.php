<?php

namespace app\modules\blog\forms;

use app\models\User;
use yii\base\Model;

class SingupForm extends Model
{
    public $name;
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['name','email','password'], 'required'],
            [['name'], 'string'],
            [['email'], 'email'],
            [['email'], 'unique', 'targetClass'=>'app\models\User', 'targetAttribute'=>'email']
        ];
    }
    public function singUp()
    {
        if($this->validate()){
            $user = new User();
            $user->attributes = $this->attributes;
            return $user->create();
        }
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Богдан
 * Date: 27.03.2017
 * Time: 12:14
 */

namespace app\models;
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
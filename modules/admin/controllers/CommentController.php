<?php

namespace app\modules\admin\controllers;

use app\models\Comment;
use yii\web\Controller;

class CommentController extends Controller
{
    public function actionIndex()
    {
        $model = Comment::find()->orderBy('id desc')->all();
        return $this->render('index', [
           'comments' => $model
        ]);
    }
    public function actionDelete($id)
    {
        $comment = Comment::findOne($id);
        if($comment->delete()){
            return $this->redirect(['comment/index']);
        }
    }
    public function actionAllow($id){
        $model = Comment::findOne($id);
        if($model->allow()){
            return $this->redirect(['comment/index']);
        }
    }
    public function actionDisallow($id){
        $model = Comment::findOne($id);
        if($model->disallow()){
            return $this->redirect(['comment/index']);
        }
    }
}
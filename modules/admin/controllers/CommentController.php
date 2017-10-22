<?php

namespace app\modules\admin\controllers;

use app\repositories\CommentRepository;
use yii\web\Controller;

class CommentController extends Controller
{
    public function actionIndex()
    {
        $model = CommentRepository::find()->orderBy('id desc')->all();
        return $this->render('index', [
           'comments' => $model
        ]);
    }
    public function actionDelete($id)
    {
        $comment = CommentRepository::findOne($id);
        if($comment->delete()){
            return $this->redirect(['comment/index']);
        }
    }
    public function actionAllow($id){
        $model = CommentRepository::findOne($id);
        if($model->allow()){
            return $this->redirect(['comment/index']);
        }
    }
    public function actionDisallow($id){
        $model = CommentRepository::findOne($id);
        if($model->disallow()){
            return $this->redirect(['comment/index']);
        }
    }
}
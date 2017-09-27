<?php
namespace app\controllers;

use app\forms\LoginForm;
use app\forms\SingupForm;
use app\models\User;
use Yii;
use yii\web\Controller;

class AuthController extends Controller
{
    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    public function actionSingup()
    {
        $model = new SingupForm();
        if(Yii::$app->request->isPost){
            $model->load(Yii::$app->request->post());
            if($model->singUp()){
                return $this->redirect(['auth/login']);
            }
        }
        return $this->render('/site/singup', [
            'model' => $model
        ]);
    }
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('/site/login', [
            'model' => $model,
        ]);
    }
    public function actionLoginVk($uid, $first_name, $photo){
        $user = new User();
        if($user->saveFromVk($uid,$first_name, $photo)){
            return $this->goHome();
        }
    }
}
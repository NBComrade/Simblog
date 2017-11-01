<?php
namespace app\modules\blog\controllers;

use app\modules\blog\forms\LoginForm;
use app\modules\blog\forms\SingupForm;
use app\models\User;
use \InvalidArgumentException;
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

    /**
     * Registration action
     *
     * @return string|\yii\web\Response
     * @throws InvalidArgumentException
     */
    public function actionSingup()
    {
        $model = new SingupForm();
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            if ($model->validate() && User::create($model->attributes)) {
                return $this->redirect(['auth/login']);
            } else {
                throw new InvalidArgumentException("Invalid information for singup!");
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
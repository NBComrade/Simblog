<?php

namespace app\modules\blog\controllers;

use app\repositories\ArticleRepository;
use app\repositories\CategoryRepository;
use app\modules\blog\forms\CommentForm;
use app\repositories\CommentRepository;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\modules\blog\forms\LoginForm;
use app\modules\blog\forms\ContactForm;
use Exception;
use Yii;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        $data =  ArticleRepository::getAll(3);

        return $this->render('index', [
            'articles' =>$data['articles'],
            'pagination' => $data['pagination'],
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * @param $id
     * @return string
     */
    public function actionView($id)
    {
        $article = ArticleRepository::findOne($id);
        $comments = $article->getArticleComments();
        $user = $article->getArticleAuthor();
        $tags = $article->getArticleTags();
        $categoryArticles = CategoryRepository::getArticlesByCategoryId(CategoryRepository::getCategoryIdByArticleId($article->id));
        $commentForm = new CommentForm();
        $article->viewedCounter();
        return $this->render('single',[
            'comments' => $comments,
            'commentForm' => $commentForm,
            'user' => $user,
            'tags' => $tags,
            'categoryArticles' => $categoryArticles,

        ]);
    }
    public function actionCategory($id)
    {
        $data = CategoryRepository::getArticlesByCategory($id, 2);

        return $this->render('category',[
            'article' =>$data['articles'],
            'pagination' => $data['pagination'],
        ]);
    }

    /**
     * Action for add new comment
     * @param $id
     * @return \yii\web\Response
     */
    public function actionComment($id)
    {
        $model = new CommentForm();
        try {
            if (Yii::$app->request->isPost) {
                $model->load(Yii::$app->request->post());
                if (CommentRepository::saveNewComment($model, $id)) {
                    return $this->redirect(['site/view', 'id' => $id]);
                }
            }
            Yii::$app->getSession()->setFlash("success.comment", 'Your comment will be added soon!');
        } catch (Exception $e) {
            Yii::$app->getSession()->setFlash("wrong.comment", $e->getMessage());
        }
        return $this->redirect(['site/view', 'id' => $id]);
    }
}

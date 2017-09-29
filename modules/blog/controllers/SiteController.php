<?php

namespace app\modules\blog\controllers;

use app\models\Article;
use app\models\Category;
use app\modules\blog\forms\CommentForm;
use app\models\Testemonials;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\modules\blog\forms\LoginForm;
use app\modules\blog\forms\ContactForm;

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

        $data =  Article::getAll(3);
        $popular = Article::getPopular();
        $last = Article::getLast();
        $categories = Category::getAll();
        $testemonials = Testemonials::find()->all();
        $rabndPost = Article::getRandomPost();

        return $this->render('index', [
            'articles' =>$data['articles'],
            'pagination' => $data['pagination'],
            'popular' => $popular,
            'last' => $last,
            'categories' => $categories,
            'testemonials' => $testemonials,
            'randPost' => $rabndPost
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
    public function actionView($id)
    {
        $article = Article::findOne($id);
        $popular = Article::getPopular();
        $rabndPost = Article::getRandomPost();
        $last = Article::getLast();
        $categories = Category::getAll();
        $comments = $article->getArticleComments();
        $user = $article->getArticleAuthor();
        $tags = $article->getArticleTags();
        $testemonials = Testemonials::find()->all();
        $categoryArticles = Category::getArticlesByCategoryId(Category::getCategoryIdByArticleId($article->id));
        $commentForm = new CommentForm();
        $article->viewedCounter();
        return $this->render('single',[
            'article' => $article,
            'popular' => $popular,
            'last' => $last,
            'categories' => $categories,
            'comments' => $comments,
            'commentForm' => $commentForm,
            'user' => $user,
            'tags' => $tags,
            'categoryArticles' => $categoryArticles,
            'testemonials' => $testemonials,
            'randPost' => $rabndPost
        ]);
    }
    public function actionCategory($id)
    {
        $data = Category::getArticlesByCategory($id, 2);
        $popular = Article::getPopular();
        $last = Article::getLast();
        $categories = Category::getAll();
        $testemonials = Testemonials::find()->all();
        $rabndPost = Article::getRandomPost();
        return $this->render('category',[
            'article' =>$data['articles'],
            'pagination' => $data['pagination'],
            'popular' => $popular,
            'last' => $last,
            'categories' => $categories,
            'testemonials' => $testemonials,
            'randPost' => $rabndPost
        ]);
    }
    public function actionComment($id)
    {
        $model = new CommentForm();

        if(Yii::$app->request->isPost){
            $model->load(Yii::$app->request->post());
            if($model->saveComment($id)){
                return $this->redirect(['site/view', 'id'=> $id]);
            }
        }
        Yii::$app->getSession()->setFlash("comment", 'Your comment will be added soon!');
        return $this->redirect(['site/view', 'id'=> $id]);
    }
}

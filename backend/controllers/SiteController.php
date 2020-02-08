<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\web\Cookie;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'language'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'set-cookie', 'get-cookie'],
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
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
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
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        //$this->layout = 'loginLayout';
        //$result = Yii::$app->mycomponent->currencyConverter('USD', 'LKR', 100);
        //print_r($result);
        //die();
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

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

    public function actionSetCookie() {
        $cookie = new Cookie([
            'name' => 'test',
            'value' => 'Test cookie value'
        ]);

        Yii::$app->getResponse()->getCookies()->add($cookie);
    }

    public function actionGetCookie() {
        if (Yii::$app->getRequest()->getCookies()->has('test')) {
            print_r(Yii::$app->getRequest()->getCookies()->getValue('test'));
        }
    }

    public function actionLanguage() {
        if (isset($_POST['lang'])) {
            Yii::$app->language = $_POST['lang'];
           $lang = $_POST['lang'];
           $cookie = new Cookie([
               'name' => 'lang',
               'value' => $lang
           ]);
           Yii::$app->getResponse()->getCookies()->add($cookie);
        }
    }
}

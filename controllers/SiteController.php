<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\RegisterForm;
use Symfony\Component\VarDumper\VarDumper as VarDumper;
use yii\bootstrap5\ActiveForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
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
                'class' => VerbFilter::class,
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
        Yii::debug(Yii::$app->security->generatePasswordHash('123123'));
        //  VarDumper::dump(Yii::$app->user?->identity?->isAdmin);
        // // VarDumper::dump(Yii::$app->user?->identity?->getUserLogin());
        // // VarDumper::dump(Yii::$app->user?->identity?->userLogin);
        
        // // VarDumper::dump(Yii::$app->user->identity->login);
        //  die;

        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::$app->session->setFlash('info', 'Вы успешно вошли в системе.');
            return  
                Yii::$app->user->identity->isAdmin
                        ? $this->redirect('/admin-panel')
                        : $this->redirect('/account');            
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        Yii::$app->session->setFlash('info', 'Вы успешно вышли из системы.');

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
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


    public function actionRegister()
    {
        $model = new RegisterForm();

        // if ($this->request->isPost)
        //false                     []
        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }

            // VarDumper::dump(Yii::$app->request->post(), 10, true); die;

            if ($user = $model->register()) {
                if (Yii::$app->user->login($user, 60*60)) {
                    Yii::$app->session->setFlash('success', 'Вы успешно зарегистрировались в системе.');
                    return Yii::$app->user->identity->isAdmin
                        ? $this->redirect('/admin-panel')
                        : $this->redirect('/account');
                }
                // VarDumper::dump($user, 1, true); die;
            }

            
            // VarDumper::dump($model, 10, true); die;
            // VarDumper::dump(Yii::$app->request->post(), 10, true);
            // VarDumper::dump(Yii::$app->request->post('RegisterForm'), 10, true);

            // $model->name = Yii::$app->request->post('RegisterForm')['name'];
            // $model->surname = Yii::$app->request->post('RegisterForm')['surname'];
            // VarDumper::dump($model->attributes, 1, true); die;
        }

        return $this->render('register', compact('model'));
    }



    public function actionMail()
    {

        Yii::$app->mailer->htmlLayout = '@app/mail/layouts/html';

        if (Yii::$app->mailer
            ->compose('mail', [])
            ->setFrom('iv2-22-web@mail.ru')
            ->setTo('iv2-22-web@mail.ru')
            ->setSubject('test')
            ->send()
        ) {

            Yii::$app->session->setFlash('success', 'send mail');
        } else {
            Yii::$app->session->setFlash('error', 'error send mail');
        }

        return $this->render('index');
    }
}

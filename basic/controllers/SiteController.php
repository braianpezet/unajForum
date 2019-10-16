<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\widgets\ActiveForm;
use app\models\FormRegister;
use app\models\Users;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Notificacion;
use app\models\NotificacionSearch;
use yii\data\Pagination;


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
            return $this->goBack();
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

        return $this->goHome();
    }

    private function randKey($str='', $long=0)
    {
        $key = null;
        $str = str_split($str);
        $start = 0;
        $limit = count($str)-1;
        for($x=0; $x<$long; $x++)
        {
            $key .= $str[rand($start, $limit)];
        }
        return $key;
    }
  
    public function actionRegister()
    {
        $model = new FormRegister;

        $msg = null;
        
        //Validación mediante ajax
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $table = new Users;
                $table->username = $model->username;
                $table->email = $model->email;
                $table->password = $this->encrypt_decrypt('encrypt', $model->password);
                $table->authKey = $this->randKey("abcdef0123456789", 200);
                $table->accessToken = $this->randKey("abcdef0123456789", 200);

                if ($table->insert()) {
                    $user = $table->find()->where(["email" => $model->email])->one();
                    $id = urlencode($user->id);
                    $authKey = urlencode($user->authKey);

                    $subject = "Confirmar registro";
                    $body = "<h1>Haga click en el siguiente enlace para finalizar tu registro</h1>";
                    $body .= "<a href='http://unajforum/index.php?r=site/confirm&id=".$id."&authKey=".$authKey."'>Confirmar</a>";
                    
                    //Enviamos el correo
                    Yii::$app->mailer->compose()
                        ->setTo($user->email)
                        ->setFrom([Yii::$app->params["adminEmail"] => Yii::$app->params["title"]])
                        ->setSubject($subject)
                        ->setHtmlBody($body)
                        ->send();

                    $session = Yii::$app->session;
                    echo "Usuario registrado. Sólo falta que confirme desde su correo electrónico";
                    $model->username = null;
                    $model->email = null;
                    $model->password = null;
                    $model->password_repeat = null;
                } else {
                    $msg = "Ha ocurrido un error al llevar a cabo el registro";
                }
            } else {
                $model->getErrors();
            }
        }
        return $this->render("register", ["model" => $model, "msg" => $msg]);
    }


    public function actionConfirm()
    {
        $table = new Users;

        if (Yii::$app->request->get()) {
            $id = Html::encode($_GET["id"]);
            $authKey = $_GET["authKey"];

            if ((int)$id) {
                $model = $table
                    ->find()
                    ->where("id=:id", [":id" => $id])
                    ->andWhere("authKey=:authKey", [":authKey" => $authKey]);

                if ($model->count() == 1) {
                    $activar = Users::findOne($id);
                    $activar->activate = 1;
                    if ($activar->update()) {
                        echo "Registro realizado correctamente, redireccionando ...";
                        echo "<meta http-equiv='refresh' content='8; " . Url::toRoute("site/login") . "'>";
                    } else {
                        echo "Ha ocurrido un error, redireccionando ...";
                        echo "<meta http-equiv='refresh' content='8; " . Url::toRoute("site/login") . "'>";
                    }
                } else {
                    return $this->redirect(["site/login"]);
                }
            } else {
                return $this->redirect(["site/login"]);
            }
        }
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

    public function actionNoti()
    {
        $query = Notificacion::find()
            ->where(['ID_USER_EMISOR' => Yii::$app->user->identity->id])
            ->orwhere(['ID_USER_RECEPTOR' => Yii::$app->user->identity->id]);

       

        $pagination = new Pagination([
            'defaultPageSize' => 20,
            'totalCount' => $query->count(),
        ]);

        $notificacion = $query->orderBy(['Fecha' => SORT_DESC])
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        if ($_POST != null) {
                $ID_Usuarios = $_POST['Notificacion'];
                $mensaje = $_POST['Notificacion'];
                $ID_Usuarios = $ID_Usuarios['ID_USER_RECEPTOR'];
                $mensaje = $mensaje['NOTIFICACION'];
                foreach ($ID_Usuarios as $user1) {
                    $model1 = new Notificacion();
                    $model1->ID_USER_EMISOR = Yii::$app->user->identity->id;
                    $model1->ID_USER_RECEPTOR = $user1;
                    $model1->NOTIFICACION = $this->encrypt_decrypt('encrypt', $mensaje);
                    $model1->FECHA = new \yii\db\Expression('NOW()');
                    $model1->save();
                        //Enviamos correo
                     $receptor = Users::findOne($user1)->username;
                     $emisor = Users::findOne($model1->ID_USER_EMISOR)->username;
                     $mail = Users::findOne($user1)->email;
                     $subject = "Nueva notificación";
                     $body = "<p>Hola <strong>" . $receptor . "</strong>, tenes una nueva notificación de <strong>" . $emisor . "</strong>.</p>";
                     $body .= "<p> Notificación: <i>" . $mensaje . "</i></p>";
                     $body .= "<p><a href='http://yii.local/site/noti'>Ver notificación</a></p>";
                     try {
                         Yii::$app->mailer->compose()
                             ->setTo($mail)
                             ->setFrom([Yii::$app->params["adminEmail"] => Yii::$app->params["title"]])
                             ->setSubject($subject)
                             ->setHtmlBody($body)
                             ->send();
                     } catch (\Swift_TransportException $e) {
                     }
                }
                if ($model1->save()) {
                    $session = Yii::$app->session;
                    return $this->redirect('noti');
                }
            }
        

        $model = new Notificacion();
        $usuarios = Users::find()->where(['not', ['username' => Yii::$app->user->identity->username]])
            ->andWhere(['activate' => 1])->asArray()->all();
        return $this->render('noti', [
            'notificacion' => $notificacion,
            'pagination' => $pagination,
            'model' => $model,
            'usuarios' => $usuarios,
        ]);
    }

    public function encrypt_decrypt($action, $string)
    {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'jtdsy8j1elj8gi25';
        $secret_iv = 'qp8ybcpablf2e6rk';
        // hash
        $key = hash('sha256', $secret_key);
        //iv
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if( $action == 'decrypt' ) {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }
}

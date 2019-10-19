<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\FormRegister;
use app\models\Users;
use app\models\FormChangePassword;
use app\models\FormPerfil;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\Notificacion;
use app\models\User;
use yii\data\Pagination;
use yii\data\ActiveDataProvider;

class UserController extends Controller
{
   

    public function actionGetunamebyid($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $username = Users::findOne($id)->username;
        return $username;
    }
    public function actionCurrentuserisguest()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if (User::isUserGuest(Yii::$app->user->identity->id)) {
            return "true";
        }
        return "false";
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionChangepw()
    {

        $id = Yii::$app->user->identity->id;

        $model = new FormChangePassword($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->changePassword()) {
            $model->current_password = null;
            $model->password = null;
            $model->confirm_password = null;
        }

        return $this->render('changepw', [
            'model' => $model,
        ]);
    }
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);

        if ($_POST != null) {
            $user = $_POST['Users'];
            $username = $user['username'];
            $email = $user['email'];
            $rol = $user['rol'];
            $model->username = $username;
            $model->email = $email;
            $model->rol = $rol;
            $model->save();
            if ($model->save()) {
                return $this->redirect('../admin/users');
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    public function actionUpdateprofile($id)
    {
       
        $model = $this->findModel($id);
         $model1 = new FormPerfil($id);
        $usuario = Users::findOne($id);
        if ($_POST != null) {
            $imageName = $usuario->username; /*nombre de la foto es el username*/
            $model1->file = UploadedFile::getInstance($model1,'file');
            if ($model1->file !=null){
            $model1->file->saveAs('uploads/'.$imageName.'.'.$model1->file->extension);
            $usuario->profile_picture = '../uploads/'.$imageName.'.'.$model1->file->extension; /*guardo ruta en db*/
            $usuario->save();
            }
            $user = $_POST['Users'];
            $username = $user['username'];
            $email = $user['email'];
            $fecha = $user['fecha_de_nacimiento'];
            $extracto = $user['extracto'];
            $model->fecha_de_nacimiento = $fecha;
            $model->extracto = $extracto;
            $model->username = $username;
            $model->email = $email;
            $model->save();
        }

        return $this->render('updateperfil', [
            'usuario' => $usuario,
            'model' => $model,
            'model1' => $model1,
        ]);
    }

}
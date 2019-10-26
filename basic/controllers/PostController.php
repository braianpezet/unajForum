<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Post;
use app\models\User;
use app\models\Etiqueta;
use app\models\Etiqueta_post;
use app\models\PostSearch;
use app\models\ComentarioPost;
use app\models\Comentario;
use app\models\FormPostFoto;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\web\UploadedFile;
use yii\base\Security;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
   
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'delete', 'update','index'],
                'rules' => [
                    [
                        //El administrador tiene permisos sobre las siguientes acciones
                        'actions' => ['create','delete','update','index'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return User::isUserAdmin(Yii::$app->user->identity->id);
                        },
                    ],
                    [
                       //Los usuarios simples tienen permisos sobre las siguientes acciones
                        'actions' => ['create','update'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return User::isUserSimple(Yii::$app->user->identity->id);
                        },
                    ],
                    [
                        //Los usuarios guest tienen permisos sobre las siguientes acciones
                        'actions' => [],
                        'allow' => false,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return User::isUserGuest(Yii::$app->user->identity->id);
                        },
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionVistav($id)
    {
        $idsubcategoria =$id;
        $query = Post::find()
            ->where(['id_subcategoria' => $id]);

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);

        $post = $query->orderBy('ID')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();



        return $this->render('vistav', [
            'post' => $post,
            'pagination' => $pagination,
            'id' => $id,
        ]);


    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $modelComentario = new ComentarioPost();
        $modelComentarioDB = new Comentario();
        if ($_POST != null) {
            $idUsario =  Yii::$app->user->identity->id;
            $idPost = $id;
            $mensaje = $_POST['ComentarioPost'];
            $comentario = $mensaje['contenido'];;
            $modelComentarioDB->id_usuario = $idUsario;
            $modelComentarioDB->id_post = $idPost;
            $modelComentarioDB->contenido = $comentario;
            $modelComentarioDB->save();
        }
        $model->visitas = $model->visitas +1;
        $model->save(); 
        $query = Comentario::find()
            ->where(['id_post' => $id]);    
        $comentarios = $query->orderBy('ID')
            ->all();
    
        return $this->render('view', [
            'model' => $model,
            'modelComentario' => $modelComentario,
            'comentarios' => $comentarios,
        ]);
    }

    public function actionLike()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $id = $data['id'];
            $post = $this->findModel($id);
            $post->megusta = $post->megusta + 1;
            $post->save(false);
            $search = $post->megusta;
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                'search' => $search,
                'code' => 100,
            ];
        }
    }

    
    public function actionNolike()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $id = $data['id'];
            $post = $this->findModel($id);
            $post->dislike = $post->dislike + 1;
            $post->save(false);
            $search = $post->dislike;
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                'search' => $search,
                'code' => 100,
            ];
        }
    }

    public function actionLikecomentario()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $id = $data['id'];
            $comentario = Comentario::find()->where(['id' => $id])->One();
            $comentario->megusta = $comentario->megusta +1 ;
            $comentario->save(false);
            $search = $comentario->megusta;
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                'search' => $search,
                'code' => 100,
            ];
        }
    }

    public function actionLikecomentariono()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $id = $data['id'];
            $comentario = Comentario::find()->where(['id' => $id])->One();
            $comentario->dislike = $comentario->dislike +1 ;
            $comentario->save(false);
            $search = $comentario->dislike;
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                'search' => $search,
                'code' => 100,
            ];
        }
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $etiquetas  = Etiqueta::find()->asArray()->all();
        $modelEtiqueta = new Etiqueta();
        $modelPicture = new FormPostFoto();
        $model = new Post();
        $model->id_subcategoria= $id;
        $idusuario = Yii::$app->user->identity->id;
        $security = new Security();
        $imageName = $security->generateRandomString();
        $modelPicture->file = UploadedFile::getInstance($modelPicture,'file');
        if ($modelPicture->file !=null){
            $modelPicture->file->saveAs('uploads/'.$imageName.'.'.$modelPicture->file->extension);
            $model->post_picture = '../uploads/'.$imageName.'.'.$modelPicture->file->extension; /*guardo ruta en db*/
            }
        if($_POST != null){
            $model->id_usuario = $idusuario;
            $post = $_POST['Post'];
            $descCorta = $post['des_corta'];
            $contenido = $post['contenido'];
            $nombre = $post['nombre'];
            $model->nombre = $nombre;
            $model->des_corta = $descCorta;
            $model->contenido = $contenido;
            $model->save();
            $datos = $_POST['Etiqueta'];
            $datos = $datos['id'];
            foreach ($datos as $d){
                $aux = Etiqueta::find()->where(['id' => $d])->one();
                if($aux == null){
                    $modelEtiquetaPost = new Etiqueta_post();
                    $modelEtiquetaAux = new Etiqueta();
                    $modelEtiquetaAux->nombre = $d;
                    $modelEtiquetaAux->save();
                    $modelEtiquetaPost->id_post = $model->id;
                    $modelEtiquetaPost->id_etiqueta = $modelEtiquetaAux->id;
                    $modelEtiquetaPost->save();
                }
                else{
                    $modelEtiquetaPost = new Etiqueta_post();
                    $modelEtiquetaPost->id_post = $model->id;
                    $modelEtiquetaPost->id_etiqueta = $aux->id;
                    $modelEtiquetaPost->save();
                }
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        
       
       

        return $this->render('create', [
            'model' => $model,
            'modelPicture' => $modelPicture,
            'modelEtiqueta' => $modelEtiqueta,
            'etiquetas' => $etiquetas,
        ]);
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $etiquetas  = Etiqueta::find()->asArray()->all();
        $modelEtiqueta = new Etiqueta();
        $model = $this->findModel($id);
        $modelPicture = new FormPostFoto();
        $security = new Security();
        $imageName = $security->generateRandomString();
        $modelPicture->file = UploadedFile::getInstance($modelPicture,'file');
        if ($modelPicture->file !=null){
            $modelPicture->file->saveAs('uploads/'.$imageName.'.'.$modelPicture->file->extension);
            $model->post_picture = '../uploads/'.$imageName.'.'.$modelPicture->file->extension; /*guardo ruta en db*/
            $model->save();
            }
            if($_POST != null){
                $post = $_POST['Post'];
                $descCorta = $post['des_corta'];
                $contenido = $post['contenido'];
                $nombre = $post['nombre'];
                $model->nombre = $nombre;
                $model->des_corta = $descCorta;
                $model->contenido = $contenido;
                $model->save();
                $datos = $_POST['Etiqueta'];
                $datos = $datos['id'];
                if($datos !=null){
                foreach ($datos as $d){
                    $aux = Etiqueta::find()->where(['id' => $d])->one();
                    if($aux == null){
                        $modelEtiquetaPost = new Etiqueta_post();
                        $modelEtiquetaAux = new Etiqueta();
                        $modelEtiquetaAux->nombre = $d;
                        $modelEtiquetaAux->save();
                        $modelEtiquetaPost->id_post = $model->id;
                        $modelEtiquetaPost->id_etiqueta = $modelEtiquetaAux->id;
                        $modelEtiquetaPost->save();
                    }
                    else{
                        $modelEtiquetaPost = new Etiqueta_post();
                        $modelEtiquetaPost->id_post = $model->id;
                        $modelEtiquetaPost->id_etiqueta = $aux->id;
                        $modelEtiquetaPost->save();
                    }
                
                }
            }
            }
    
        

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'etiquetas' => $etiquetas,
            'modelPicture' => $modelPicture,
            'modelEtiqueta' => $modelEtiqueta,
        ]);
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

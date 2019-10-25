<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use app\models\Users;
use app\models\Archivos;
use app\models\Etiqueta_post;
use app\models\Etiqueta;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<style>

.postContenido img{
    max-width:100%;
}

.postContenido{
    min-height:550px;
    border: 1px solid lightgray;
    border-radius:5px;
    padding: 15px;
}

.post-comentario{
    border:1px solid lightgray;
    border-radius: 5px;
}

.cantidad-comentarios{
    border-bottom:1px solid lightgray;
    padding:0px 10px;
}

.comentarios-usuarios{
    padding:0px 10px;
    border-bottom:1px solid lightgray;
}

.form-comentario{
    display:flex;
    padding:5px 0px;
}

.comentario-usuario{
    display:flex;
    border-bottom:1px solid lightgray;
    padding: 10px 0px;
}
.comentario-foto img{
    border-radius:100%;
    height:60px;
    width:60px;
    float:left;
}

.contenido-comentario{
    padding:2px 5px;
}

.form-foto img{
    height:60px;
    width:60px;
    float:left;
}

.form-input{
    width:100%;
    padding: 0px 10px;
}

.botones-comentario{
    display:flex;
    color:lightgray;
}

.botones-comentario .btn{
    padding:0px 0px;
    margin-left: 2px;
    height:20px;
    background-color:transparent;
}

#like:hover{
    color:green;
}

#dislike:hover{
    color:red;
}

.archivosAdjuntos{
    border: 1px solid lightgray;
    border-radius: 8px;
    margin-top: 10px;
}

.archivosAdjuntos-header{
    border-bottom: 1px solid lightGray;
    padding: 2px 2px;
}

.panelVotacion{
    display: flex;
}

.panelVotacion p{
    margin: 5px 0px;
}

.archivosAdjuntos{
    display: inline-flex;
    min-height: 50px;
    justify-content: center;
    justify-self:center;
    justify-self: center;
}

.archivosAdjuntosHeader{
    padding: 15px;
    border-right: 1px solid lightgray;
}

.archivosAdjuntosContenido{
    display: flex;
    flex-direction: column;
    padding:5px;
}

.contentt{
    display:flex;
}

.no-registrado{
    display:grid;
    justify-self:center;
    margin: 0 auto;
}

@media (max-width: 768px) {
    .contenido{
        margin-top:5px;
        padding:0px;
    }
}


</style>


<div style="float:none" class="col-lg-6 col-md-8 col-sm-12 float-none">

<div class="postContenido">
<?php if(!Yii::$app->user->isGuest):?>
<?php if($model->id_usuario == Yii::$app->user->identity->id):?>
<a class="btn btn-success" href="/index.php?r=post%2Fupdate&id=<?=$model->id?>" role="button">Modificar Post</a>
<a class="btn btn-success" href="/index.php?r=archivos%2Fcreate&id=<?=$model->id?>">Agregar archivos adjuntos</a>
<?php endif?>
<?php endif?>
    <h1><?= Html::encode("{$model->nombre} ") ?></h1>
    <div class="boxPostContentido">
        <?= $model->contenido?>
    </div>
    <div class="panelVotacion">
        <a id="like" class="btn"><i class="fa fa-thumbs-up"></i></a>
        <p id="likeContador" style='color:green'>++<?=$model->megusta?></p>
        <a id="dislike" class="btn"><i class="fa fa-thumbs-down"></i></a>
        <p id="dislikeContador" style='color:red'>--<?=$model->dislike?></p>
    </div>
    <script>
       $('#like').on("click", () => {
            $.ajax({
            url: $(location).attr('pathname') + '?r=post/like',
            type: 'post',
            data: {
                 meGusta: 1 , 
                 id: <?php echo $model->id ?> , 
                 _csrf : '<?=Yii::$app->request->getCsrfToken()?>'
             },
                success: function (data) {
                    $('#likeContador').html('++' + data.search); 
                    console.log(data.search);
                }
            });
       });
       $('#dislike').on("click", () => {
            $.ajax({
            url: $(location).attr('pathname') + '?r=post/nolike',
            type: 'post',
            data: {
                 meGusta: 1 , 
                 id: <?php echo $model->id ?> , 
                 _csrf : '<?=Yii::$app->request->getCsrfToken()?>'
             },
                success: function (data) {
                    $('#dislikeContador').html('--' + data.search); 
                    console.log(data.search);
                }
            });
       });
    </script>
    <?php $archivos = Archivos::find()->where(['id_post' => $model->id])->all();?>


<div class="etiquetasPost">
       <?php $etiquetas = Etiqueta_post::find()->where(['id_post' => $model->id])->all()?>
       <div class="etiquetasPostContenido">
       <?php foreach($etiquetas as $etiqueta):?>
            <?php $eti = Etiqueta::find()->where(['id' => $etiqueta->id_etiqueta])->one();?>
            <div class="etiqueta">
            <a href='index.php?r=etiqueta%2Fview&id=<?= $eti->id?>'> <?= $eti->nombre ?></a>
            </div>
       <?php endforeach?>
       </div>
</div>


<?php if($archivos !=null):?>
<div class="archivosAdjuntos">
    <div class="archivosAdjuntosHeader">
        <i class="fas fa-paperclip"></i>
    </div>
    <div class="archivosAdjuntosContenido">
    <?php foreach($archivos as $a):?>
       <?php $nombre = explode('/', $a->url);?>
        <a href="<?= $a->url?>" download><?=$nombre[2]?></a>
        <?php endforeach?>
    </div>
</div>
<?php endif?>
</div>



<div class="post-comentario" style="clear:both; margin-top: 10px">

<?php Pjax::begin(); ?>



    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true ]]); ?>
    <div class="cantidad-comentarios">
        <h3> <?= count($comentarios)?> Comentarios </h3>
    </div>

    
      
    <?php foreach($comentarios as $comennt):?>
    <div class="comentario-usuario">
        <div class="comentario-foto">
            <?php if($comentarios !=0):?>
            <?php $usuario1 = Users::findOne($comennt->id_usuario); ?>
            <?php if ($usuario1->profile_picture ==""):?>
                        <img src="/img/avatar.png">
                    <?php else: ?>
					    <img src="<?= $usuario1->profile_picture ?>">
            <?php endif ?>
            <?php endif?> 
            
        </div>
        <div class="contenido-comentario">
            <p style="color:cornflowerblue"><?= $usuario1->username?> </p>
            <p><?= $comennt->contenido ?></p>
            <div class="botones-comentario">
                <p style="color:green">0</p>
                <?= Html::a('', ['post/likecomentario'], ['class' => 'btn fa fa-thumbs-up']) ?>
                <button id="dislike" class="btn" title="no me gusta"> <i class="fa fa-thumbs-down"></i> </button>
                <button class="btn" title="responder"> <i class="fa fa-angle-down"></i> </button>
            </div>
        </div>
      
    </div>
    <?php endforeach?>
    
    
    <div class="form-comentario">
    <?php if(!Yii::$app->user->isGuest):?>
    <div class="form-foto">
    <?php $usuario1 = Users::findOne( Yii::$app->user->identity->id); ?>
            <?php if ($usuario1->profile_picture ==""):?>
                        <img src="../img/avatar.png">
                    <?php else: ?>
					    <img src="<?= $usuario1->profile_picture ?>">
            <?php endif ?>
    </div>
    <div class="form-input">
    <?= $form->field($modelComentario, 'contenido')->textInput()->input('contenido',['placeholder' => 'añade un comentario'])->label('Comentar') ?>
    <div class="form-group">
        <?= Html::submitButton('Comentar', ['class' => 'btn btn-success','style' => 'float:right']) ?>
    </div>
    <?php else:?>
        <div class="no-registrado">
        <p>Para comentar necesitas estar registrado registrate aca:</p>
        <a href="/index.php?r=site/register"class="btn btn-success">Registrarse</a>
    <?php endif?>
    
    </div>
    </div>

    </div>
    <?php ActiveForm::end(); ?>

    

<?php Pjax::end(); ?>

</div>
</div>





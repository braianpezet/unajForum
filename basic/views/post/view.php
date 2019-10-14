<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use app\models\Users;

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


</style>

<div class="col-lg-4 col-md-8 col-sm-12">
<div class="postContenido">
    <h1><?= Html::encode("{$model->nombre} ") ?></h1>
    <div class="boxPostContentido">
        <?= $model->contenido?>
    </div>
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
                        <img src="../image/avatar.png">
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
                <button id="like" class="btn" title="Me gusta"> <i class="fa fa-thumbs-up"></i></button>
                <button id="dislike" class="btn" title="no me gusta"> <i class="fa fa-thumbs-down"></i> </button>
                <button class="btn" title="responder"> <i class="fa fa-angle-down"></i> </button>
            </div>
        </div>
      
    </div>
    <?php endforeach?>
    

    <div class="form-comentario">
    <div class="form-foto">
    <?php $usuario1 = Users::findOne( Yii::$app->user->identity->id); ?>
            <?php if ($usuario1->profile_picture ==""):?>
                        <img src="../image/avatar.png">
                    <?php else: ?>
					    <img src="<?= $usuario1->profile_picture ?>">
            <?php endif ?>
    </div>
    <div class="form-input">
    <?= $form->field($modelComentario, 'contenido')->textInput()->input('contenido',['placeholder' => 'añade un comentario'])->label('Comentar') ?>
    <div class="form-group">
        <?= Html::submitButton('Comentar', ['class' => 'btn btn-success','style' => 'float:right']) ?>
    </div>
    </div>

    </div>
    <?php ActiveForm::end(); ?>

    

<?php Pjax::end(); ?>

</div>
</div>





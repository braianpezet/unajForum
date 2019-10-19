<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Users;
use app\models\Post;
use app\models\Comentario;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<style>

.perfil{
    height:250px;
    border: 1px solid lightgray;
    border-radius: 8px;
    display:flex;
}

.perfil img{
    height:120px;
    width: 120px;
}

.perfil-content{
    padding:15px;
    display:flex;
}



.post-creados{
    height:400px;
    border:1px solid lightgray;
    border-radius: 8px;
    margin-top:25px;
}

.aportes a{
    display:block;
}

.user-comentarios{
    height:250px;
    border:1px solid lightgray;
    border-radius: 8px;
    margin-top: 25px;
}

.perfil-content-info{
    padding: 0px 5px;
}

</style>

<div class="col-lg-6 col-sm-12">
<div class="perfil">
    <div class="perfil-content">
        <?php if($model->profile_picture == null):?>
            <img src="img/avatar.png">
        <?php else:?>
            <img src=<?=$model->profile_picture?>>
        <?php endif?>
        <div class="perfil-content-info">
        <h3><?=$model->username?></h3>
        <p><?=$model->extracto?></p>
        <p><?=$model->fecha_de_nacimiento?></p>
        </div>
    </div>
</div>
    
<div class="aportes">
    <div class="post-creados col-lg-6 col-sm-12">
        <div class="post-creados-header">
        <h3>Posts</h3>
        </div>
        <div class="post-creados-content">
        <?php $post = Post::find()->where(['id_usuario' => $model->id])->all();
        foreach($post as $p):?>
            <a href="/index.php?r=post%2Fview&id=<?=$p->id?>"><?=$p->nombre ?></a>
        <?php endforeach?>
        </div>
    </div>
    <div class="user-comentarios col-lg-5 col-lg-offset-1 col-sm-12">
        <h3>Ultimos comentarios en post</h3>
        <?php $comentario = Comentario::find()->where(['id_usuario' => $model->id])->all();?>
        <?php foreach($comentario as $c):?>
        <?php $query = Post::findOne(['id' => $c->id_post]);?>
        <a href="/index.php?r=post%2Fview&id=<?=$c->id_post?>"><i class="fa fa-comments-o" style="margin-right:5px"> </i><?= $query->nombre ?></a>
        <?php endforeach?>
    </div>
</div>
</div>
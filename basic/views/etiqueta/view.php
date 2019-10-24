<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Post;
use app\models\Comentario;
use app\models\Etiqueta_post;

/* @var $this yii\web\View */
/* @var $model app\models\Etiqueta */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Etiquetas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<?php
$etiquetaPost = Etiqueta_post::find()->where(['id_etiqueta' => $model->id])->all();?>

<h1>Post con etiqueta <?=$model->nombre?></h1>
<?php
foreach($etiquetaPost as $etiqueta):
    $post = Post::find()->where(['id' => $etiqueta->id_post])->one();

?>
    <div class="postBox">
            <div class="postImg">
            <?php if($post->post_picture == null):?>
                <img src= "img/no-foto.png">
            <?php else:?>
                <img src=<?=$post->post_picture?>>
            <?php endif?>
            </div>
            <div class="post-titulo-des">
                <h1><a href="/index.php?r=post%2Fview&id=<?= Html::encode("{$post->id} ") ?>"><?= Html::encode("{$post->nombre} ") ?></a></h1>
                <p><?= $post->des_corta ?></p>
                <div class="post-stats">
            
                <?php 
                $comentarios = Comentario::find()
                    ->where(['id_post' => $post->id])->all();
                ?>
                <div title="Comentarios" class="btn-stats">
                <p><?= count($comentarios) ?> <i class="fa fa-comment"></i></p>
                </div>
                <div title="Votos" class="btn-stats">
                <p>1 <i class="far fa-thumbs-up"></i></p>
                </div>
                <div title="visitas" class="btn-stats">
                <p><?= $post->visitas ?> <i class="fa fa-bar-chart"></i></p>
                </div>
            </div>
            </div>
        </div>
<?php endforeach?>
</div>

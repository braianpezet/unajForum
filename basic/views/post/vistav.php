<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use app\models\Subcategoria;
use app\models\Comentario;


$this->title = 'Post';

?>


<?php $idSubCategoria = Subcategoria::findOne($id); ?>

<a class="btn btn-success" href="/index.php?r=post%2Fcreate&id=<?= Html::encode("{$idSubCategoria->id} ") ?>" role="button">Crear post</a>

<?php if(count($post) != 0):?>
    <?php foreach($post as $p):?>
        <div class="postBox">
            <div class="postImg">
            <?php if($p->post_picture == null):?>
                <img src= "img/no-foto.png">
            <?php else:?>
                <img src=<?=$p->post_picture?>>
            <?php endif?>
            </div>
            <div class="post-titulo-des">
                <h1><a href="/index.php?r=post%2Fview&id=<?= Html::encode("{$p->id} ") ?>"><?= Html::encode("{$p->nombre} ") ?></a></h1>
                <p><?= $p->des_corta ?></p>
                <div class="post-stats">
            
                <?php 
                $comentarios = Comentario::find()
                    ->where(['id_post' => $p->id])->all();
                ?>
                <div title="Comentarios" class="btn-stats">
                <p><?= count($comentarios) ?> <i class="fa fa-comment"></i></p>
                </div>
                <div title="Votos" class="btn-stats">
                <p><?= $p->megusta?> <i class="far fa-thumbs-up"></i></p>
                </div>
                <div title="visitas" class="btn-stats">
                <p><?= $p->visitas ?> <i class="fa fa-bar-chart"></i></p>
                </div>
            </div>
            </div>
        </div>
    <?php endforeach?>
    <?php else:?>
    <h1>No hay ningun post creado</h1>
<?php endif?>

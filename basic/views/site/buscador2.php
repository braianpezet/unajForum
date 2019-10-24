<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use app\models\Subcategoria;
use app\models\Comentario;
/* @var $this yii\web\View */
$this->title = 'Buscador';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php if(count($postCumplen) != 0):?>
    <?php foreach($postCumplen as $p):?>
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
                <p>1 <i class="far fa-thumbs-up"></i></p>
                </div>
                <div title="visitas" class="btn-stats">
                <p><?= $p->visitas ?> <i class="fa fa-bar-chart"></i></p>
                </div>
            </div>
            </div>
        </div>
    <?php endforeach?>
    <?php else:?>
    <h1>No se encontraron resultados</h1>
<?php endif?>

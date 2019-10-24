<?php
use app\models\Categoria;
use app\models\Subcategoria;
use app\models\Post;
use app\models\User;
use app\models\Etiqueta;
use yii\helpers\Html;
use yii\data\Pagination;

/* @var $this yii\web\View */

$this->title = 'Unaj Forum';

?>

<style>

.categoria h2{
    background-color: #2799d7;
    padding: 10px;
    color:White;
}

.sub-categoria{
    height: 50px;
    display:flex;
    align-items:center;
    margin-left: 20px;
    color:black;
    cursor:pointer;
}

.sub-categoria a{
    margin: 0px;
    font-weight: bold;
    margin-left:2px;

}

.logo2{
    height:40px;
    float:left;
    background-color: skyblue;
    border-radius: 100px;
    padding: 5px;
}
.logo2 img{
    max-height:100%;
}

.masPopulares{
    border: 1px solid lightgray;
    border-radius: 10px;
    margin-top: 50px;
    padding: 15px;
    background-color:white;

}

</style>

<?php

$categoria = Categoria::find()
    ->indexBy('id')
    ->all();

    $subcategoria = Subcategoria::find()->where(['id_categoria' => '2'])->all();
?>
<div class=row>
    <div class="col-lg-8 col-md-8 col-sm-12">
<?php if (!Yii::$app->user->isGuest):?>
<?php if (User::isUserAdmin(Yii::$app->user->identity->id)):?>
<a class="btn btn-success" href="/index.php?r=categoria%2Fcreate" role="button">Crear categoria</a>
<a class="btn btn-success" href="/index.php?r=subcategoria%2Fcreate" role="button">Crear sub-categoria</a>
<?php endif?>
<?php endif?>
<?php foreach($categoria as $c):?>
    <div class="categoria">
        <h2><?= Html::encode("{$c->nombre} ") ?></h2>
        <?php $subcategoria = Subcategoria::find()->where(['id_categoria' => $c->id])->all(); ?>
        <?php if (count($subcategoria) >0 ):?>
            <?php foreach($subcategoria as $sub):?>
                <div class="sub-categoria">
                    <div class="logo2">
                        <img src="img/sinCategoria.png">
                    </div>
                    <a href="/index.php?r=post%2Fvistav&id=<?= Html::encode("{$sub->id} ") ?>"><?= Html::encode("{$sub->nombre} ") ?></a>
                </div>
            <?php endforeach?>
        <?php endif?>
    </div>
    
<?php endforeach ?>
    </div>
    <div class="aside col-xl-2 col-lg-3 col-md-4 col-sm-12 col-12">

    <div class="masPopulares">
        <h3>Preguntas mas populares</h3>
        <?php 
        $query = Post::find()->orderBy('visitas')->all();
        $query2 = Post::find()->orderBy(['fecha' => SORT_DESC])->all();
        ?>
        <?php for ($i = 0; $i <= 2; $i++):?>
            <a style="display:block" href="/index.php?r=post%2Fview&id=<?=$query[$i]->id?>"><?= Html::encode($query[$i]->nombre) ?></a>
        <?php endfor?>
    </div>
    <div class="etiquetasPopulares masPopulares">
        <h3>Etiquetas mas pupulares</h3>
        <?php $etiquetas = Etiqueta::find()->all();?>
        <?php foreach($etiquetas as $etiqueta):?>
        <div class="etiqueta">
            <a href="/index.php?r=etiqueta%2Fview&id=<?=$etiqueta->id?>">
                <?= $etiqueta->nombre?>
            </a>
        </div>
        <?php endforeach?>
    </div>
    <div class="Preguntas recientes masPopulares">
        <h3> Ultimas preguntas </h3>
        <?php for ($i = 0; $i <= 2; $i++):?>
            <a style="display:block" href="/index.php?r=post%2Fview&id=<?=$query2[$i]->id?>"><?= Html::encode($query2[$i]->nombre) ?></a>
        <?php endfor?>
    </div>
    </div>
</div>

<?php
use app\models\Categoria;
use app\models\subcategoria;
use yii\helpers\Html;

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


</style>

<?php

$categoria = Categoria::find()
    ->indexBy('id')
    ->all();

    $subcategoria = Subcategoria::find()->where(['id_categoria' => '2'])->all();
?>

<a class="btn btn-success" href="/index.php?r=categoria%2Fcreate" role="button">Crear categoria</a>
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
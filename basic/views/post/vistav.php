<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\data\Pagination;
use yii\widgets\LinkPager;


$this->title = 'Post';

?>

<style>

.postBox{
    border-top:1px solid lightgray;
    border-bottom: 1px solid lightgray;
}

.postBox a{
    color:black;
    cursor:pointer;
}

.btn{
    margin:10px;
    margin-bottom: 10px !important;
}

</style>


<a class="btn btn-success" href="/index.php?r=post%2Fcreate" role="button">Crear post</a>

<?php if(count($post) != 0):?>
    <?php foreach($post as $p):?>
        <div class="postBox">
            <h1><a><?= Html::encode("{$p->nombre} ") ?></a></h1>
            <p><?= Html::encode("{$p->contenido} ") ?>
        </div>
    <?php endforeach?>
    <?php else:?>
    <h1>No hay ningun post creado</h1>
<?php endif?>

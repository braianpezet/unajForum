<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

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
    border-radius:10px;
}
</style>
<div class="postContenido col-lg-4 col-md-8 col-sm-12">
    <h1><?= Html::encode("{$model->nombre} ") ?></h1>
    <div class="boxPostContentido">
        <?= $model->contenido?>
    </div>
</div>



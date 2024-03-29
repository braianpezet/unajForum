<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = 'Create Post';
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-create">

    <h1>Crear post</h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelPicture' => $modelPicture,
        'modelEtiqueta' => $modelEtiqueta,
        'etiquetas' => $etiquetas,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Archivos */

$this->title = 'Create Archivos';
$this->params['breadcrumbs'][] = ['label' => 'Archivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="archivos-create">

    <h1>Agregar archivos adjuntos</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

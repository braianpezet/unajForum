<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Subcategoria */

$this->title = 'Create Subcategoria';
$this->params['breadcrumbs'][] = ['label' => 'Subcategorias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subcategoria-create col-lg-4">

    <h1>Crear sub-categoria</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

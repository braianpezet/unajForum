<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Categoria */

$this->title = 'Create Categoria';
$this->params['breadcrumbs'][] = ['label' => 'Categorias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoria-create col-lg-4">

    <h1>Crear categoria</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

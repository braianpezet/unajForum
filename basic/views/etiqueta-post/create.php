<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Etiqueta_post */

$this->title = 'Create Etiqueta Post';
$this->params['breadcrumbs'][] = ['label' => 'Etiqueta Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="etiqueta-post-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

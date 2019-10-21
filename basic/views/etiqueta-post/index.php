<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Etiqueta_postSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Etiqueta Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="etiqueta-post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Etiqueta Post', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_etiqueta',
            'id_post',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Post;
use app\models\Etiqueta_post;

/* @var $this yii\web\View */
/* @var $model app\models\Etiqueta */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Etiquetas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<?php
$etiquetaPost = Etiqueta_post::find()->where(['id_etiqueta' => $model->id])->all();
foreach($etiquetaPost as $etiqueta){
    $post = Post::find()->where(['id' => $etiqueta->id_post])->one();
    var_dump($post);
}

?>

</div>

<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>

<style>

.imagenrobot{
    display:flex;
    flex-direction:column;
    text-align:center;
}

.imagenrobot img{
    width:500px;
    max-width:100%;
    margin: 0 auto;
}

</style>

<div class="site-error">
<?php if($exception->statusCode==404) : ?>
    <div class="error">
    <div class="imagenrobot">
    <img src="../img/broken-robot-2.png"/><br><br><h3>OOOPS! No pudimos encontrar esta página</h3><h1 style="font-size:100px">ERROR 404</h1>
    </div>
    </div>
<?php elseif($exception->statusCode==403) : ?>
<div class="error">
    <div class="imagenrobot">
    <img src="../img/candado.png"/><br><br><h3>Lo sentimos, no tenés permisos para realizar esta acción</h3><h1 style="font-size:100px">ERROR 403</h1>
    </div>
    </div>
<?php else : ?>
<div class="error">
    <div class="imagenrobot">
    <img src="../img/broken-robot-2.png"/><br><br><h3>Lo sentimos, ha ocurrido un error</h3><h1 style="font-size:100px">ERROR<?php echo $exception->statusCode;?></h1>
    </div>
    </div>
<?php endif; ?>
</div>


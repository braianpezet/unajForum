<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>


<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">



<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <script src="https://kit.fontawesome.com/10e4cfba33.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/index.css" />
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/index.js"></script>
    <?php $this->head() ?>
</head>




<body>

<?php $this->beginBody() ?>

<header>
    <div id='nav'>
        <button id="prueba" class="fa fa-align-justify botonSideNav"></button>
        <div class='logo'>
            <img src="img/logo.png" alt="Unaj Forum">
        </div>
        <div class= 'navDerecha'>
            <?php if (Yii::$app->user->isGuest):?>
                <a href='index.php?r=site%2Flogin'>Login</a>
            <?php else:?>
            <a href="/index.php?r=site%2Fnoti#" style="font-size:20px; padding:13px 5px;"><i class="fa fa-bell" aria-hidden="true"></i></a>
            <div class="dropdown1">
                <button class="dropbtn">  <div class="profilePictur">
                    <?php if (Yii::$app->user->identity->profile_picture == null):?>
                        <img src='img/avatar.png'>
                    <?php else:?>
                        <img src="<?= Html::encode(Yii::$app->user->identity->profile_picture)?>">
                    <?php endif?>
                </div><p class="droptexto"><?= Html::encode(Yii::$app->user->identity->username)?><i class="fa fa-caret-down" style="margin-left:4px"></i></p></button>
                <div class="dropdown-content">
                    <a href="/index.php?r=user%2Fview&id=<?= Html::encode(Yii::$app->user->identity->id)?>">Perfil</a> 
                    <a href="/index.php?r=user%2Fupdateprofile&id=<?= Html::encode(Yii::$app->user->identity->id)?>" + >Modificar perfil</a>
                    <a href="/index.php?r=user/changepw">Cambiar contraseña</a>
                    <?= Html::a('Salir', Url::to(['site/logout']),  ['data' => ['method' => 'post']]) ?>
                </div>
            </div>
            <?php endif ?>
        </div>
    </div>
</header>

<div class="wrap">
        <nav>
            <div id="mySidenav" class="sidenav">
                <a href="/index.php">Inicio</a>
                <a href='/index.php?r=site%2Fabout'>Acerca de</a>
                <a href='/index.php?r=site%2Fcontact'>Contacto</a>
                <a href="index.php?r=site%2Fbuscador">Buscador</a>
            </div>
        </nav>
    
    <div class="contenido">
        <?= $content ?>
    </div>
</div>
    
        
  
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Unaj Forum <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

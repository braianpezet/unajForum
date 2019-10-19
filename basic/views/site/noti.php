
<?php
use app\models\Notificacion;
use dominus77\sweetalert2;
use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Users;
use app\controllers\SiteController;

$this->title = 'Notificaciones';

?>

<style>
/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
  padding:15px 15px;
  background-color:chocolate;
}

.tab a{
    color:white;
}

/* Style the buttons that are used to open the tab content */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}

.boxMensaje{
    display:flex;
}

.media-body{
    padding:0px 8px;
}
}
</style>
<div class="col-lg-6">
        <div class="tab">
          <a href="#"onclick="openCity(event, 'Recibido')" id="defaultOpen"><i class="glyphicon glyphicon-inbox"></i>  Recibidas</a>
          <a href="#"onclick="openCity(event, 'Enviado')"><i class="glyphicon glyphicon-envelope"></i>  Enviadas</a>
          <a href="#"onclick="openCity(event, 'Enviar notificacion')"><i class="glyphicon glyphicon-plus"></i> Nueva notificacion</a>
        </div>
        <!-- Contenido de la pagina -->
        <div id="Recibido" class="tabcontent">
            <?php $entro = false; ?>
            <?php foreach ($notificacion as $n) :
                if ($n->uSERRECEPTOR->id == Yii::$app->user->identity->id) :?>
					<?php $entro = true; ?>
                    <?php $usuario1 = Users::findOne($n->uSEREMISOR->id); ?>
                    <div class="boxMensaje">
                    <?php if ($usuario1->profile_picture ==""):?>
                        <img src="../img/avatar.png" class="admin" style=" height:60px; width:60px; margin-left:10px; margin-bottom:10px;";>
                    <?php else: ?>
					    <img src="<?= $usuario1->profile_picture ?>" class="admin" style=" height:60px; width:60px; margin-left:10px; margin-bottom:10px;";>
                    <?php endif ?>
					<div class="media-body">
                        <h4><?= Html::encode("{$n->uSEREMISOR->username} ") ?> <small><i>Fecha: <?= Html::encode("{$n->FECHA} ") ?></i></small>
                        <small> <?= Html::a('<i class="glyphicon glyphicon-trash"></i>', Url::to(['site/noti']),  ['data' => ['confirm' => 'Estas seguro?', 'method' => 'post', 'params' => ['Notificacion' => 'borrarR', 'id' => $n->ID]]]) ?></small>
                        <a href="#"onclick="openCity(event, 'Enviar notificacion')" title="Responder"class="glyphicon glyphicon-share-alt" style="margin-left:5px" ></a>
                        </h4>
                        <p><?= SiteController::encrypt_decrypt('decrypt', $n->NOTIFICACION) ?></p>
                        <?php $n->visto = "true" ?>
                        <?php $n->save(); ?>
					</div>
                    </div>

				<?php endif; ?>
            <?php endforeach; ?>
                <?php if ($entro == false) : ?>
                    <div class="alert alert-danger">
                        <p>No tienes mensajes recibidos.</p>
                    </div>
                    <?php endif; ?>
        </div>

        <div id="Enviado" class="tabcontent">
            <?php $entro = false; ?>
            <?php foreach ($notificacion as $n) :
                if ($n->uSEREMISOR->id == Yii::$app->user->identity->id) : ?>
				    <?php $entro = true; ?>
                    <div class="boxMensaje">
                    <?php if (Yii::$app->user->identity->profile_picture ==""):?>
                        <img src="../img/avatar.png" class="admin" style="height:60px; width:60px; margin-left:10px; margin-bottom:10px;";>
                    <?php else: ?>
					    <img src= "<?= Yii::$app->user->identity->profile_picture ?>" class="admin" style="height:60px; width:60px; margin-left:10px; margin-bottom:10px;";>
                    <?php endif ?>
					<div class="media-body">
					    <h4>Para: <?= Html::encode("{$n->uSERRECEPTOR->username} ") ?>
					    <small><i>Fecha: <?= Html::encode("{$n->FECHA} ") ?></i></small>
                        <small> <?= Html::a('<i class="glyphicon glyphicon-trash"></i>', Url::to(['site/noti']),  ['data' => ['confirm' => 'Estas seguro?', 'method' => 'post', 'params' => ['Notificacion' => 'borrarE', 'id' => $n->ID]]]) ?></small></h4>
					    <p><?= SiteController::encrypt_decrypt('decrypt', $n->NOTIFICACION) ?></p>
					</div>
                    </div>
				<?php endif; ?>
            <?php endforeach; ?>
            <?php if ($entro == false) : ?>
                <div class="alert alert-danger">
                    <p>No tienes mensajes enviados.</p>
                </div>
            <?php endif; ?>
        </div>
    <div id="Enviar notificacion" class="tabcontent">
        <div class="notificacion-create">
            <?= $this->render('_form', [
                'model' => $model,
                'usuarios' => $usuarios
                ]) ?>
        </div>
    </div>
</div>

<!-- script para sidebar -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });
    function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
</html>
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<h3><?= $msg ?></h3>

<h1>Registrar</h1>
<?php $form = ActiveForm::begin([
    'method' => 'post',
 'id' => 'formulario',
 'enableClientValidation' => false,
 'enableAjaxValidation' => true,
]);
?>
<div class="col-xl-6 col-lg-6 col-sm-12 col-xs-12">
<div class="form-group">
 <?= $form->field($model, "username")->input("text")->label('Nombre de usuario') ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "email")->input("email")->label('Correo electronico') ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "password")->input("password")->label('Contaseña') ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "password_repeat")->input("password")->label('Repetir contraseña') ?>   
</div>

<?= Html::submitButton("Registrarse", ["class" => "btn btn-success"]) ?>

<?php $form->end() ?>

</div>
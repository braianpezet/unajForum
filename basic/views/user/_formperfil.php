<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Instituto;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Aula */
/* @var $form yii\widgets\ActiveForm */
?>
<style>

</style>
<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if ($usuario->profile_picture == ""): ?>
    <img src="../image/admin_icon.png" id=#avatar  alt="Avatar" style="margin-bottom:20px; border-radius: 50%; width: 200px; height:200px; border: 5px solid lavender;">
    <?php else : ?>
    <img src=<?php echo $usuario->profile_picture ?>   alt="Avatar" style="margin-bottom:20px; border-radius: 50%; width: 200px; height:200px; border: 5px solid lavender; "> 
    <?php endif ?>
        <div class = "box1">
            <?= $form->field($model1, "file")->fileInput()->label("") ?>
        </div>

        <div class="form-group">
    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?= $form->field($model, 'extracto')->textInput()->label('Acerca de vos') ?>

    <?= $form->field($model, 'fecha_de_nacimiento')->widget(
    DatePicker::className(), [
        'clientOptions' => [
            'format' => 'yyyy-M-dd'
        ]
]);?>

  
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
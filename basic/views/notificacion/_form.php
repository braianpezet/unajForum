<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Notificacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notificacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID_USER_EMISOR')->textInput() ?>

    <?= $form->field($model, 'ID_USER_RECEPTOR')->textInput() ?>

    <?= $form->field($model, 'NOTIFICACION')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FECHA')->textInput() ?>

    <?= $form->field($model, 'visto')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

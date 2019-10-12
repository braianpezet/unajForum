<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Subcategoria */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subcategoria-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_categoria')->textInput() ?>

    <?= $form->field($model, 'contenido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dec_contenido')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Etiqueta_post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="etiqueta-post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_etiqueta')->textInput() ?>

    <?= $form->field($model, 'id_post')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

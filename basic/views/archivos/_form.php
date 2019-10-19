<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;


/* @var $this yii\web\View */
/* @var $model app\models\Archivos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="archivos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_post')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?= $form->field($model, 'file')->widget(FileInput::classname(), [
        'options' => [
            'multiple' => true,
            'accept' => 'image/*'
        ],
    ]);?>


    <?php ActiveForm::end(); ?>

</div>

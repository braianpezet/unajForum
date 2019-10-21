<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true])->label('titulo') ?>

    <?= $form->field($model, 'des_corta')->textInput()->label('Descripcion corta') ?>

    <?= $form->field($model, 'contenido')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'advanced'
    ]) ?>

    <div class = "box1">
        <?= $form->field($modelPicture, "file")->fileInput()->label("Subir foto de portada:") ?>
    </div>
    
     
    <?php $result = ArrayHelper::map($etiquetas, 'id', 'nombre'); ?>
     <?=$form->field($modelEtiqueta, 'id')->widget(Select2::classname(), [
    'data' => $result,
    'options' => ['placeholder' => 'Selecciona o escribe una etiqueta ...', 'multiple' => true],
    'pluginOptions' => [
        'tags' => true,
        'tokenSeparators' => [',', ' '],
        'maximumInputLength' => 10
    ],
])->label('Tag Multiple');
?>

    <div class="form-group">
        <?= Html::submitButton('Crear post', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

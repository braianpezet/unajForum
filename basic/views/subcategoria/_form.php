<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Categoria;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Subcategoria */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subcategoria-form">

    

    <?php $form = ActiveForm::begin(); ?>

    <?php $categorias = categoria::find()->asArray()->all();
    $result = ArrayHelper::map($categorias, 'id', 'nombre'); 
    ?>
    

    <?php echo $form->field($model, 'id_categoria')->dropDownList(
        $result,
        ['prompt' => 'Choose...']
    )->label('Selecciona categoria'); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

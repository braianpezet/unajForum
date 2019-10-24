<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

$this->title = 'Buscador';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
.buscador{
}

</style>
<div class="buscador col-lg-4">
<h1><?= Html::encode($this->title) ?></h1>
<?php $form = ActiveForm::begin(); ?>
<?php echo $form->field($model,'pregunta')->textInput()->label('Palabra clave')?>
<?php echo $form->field($model, 'categoria')->widget(Select2::classname(), [
    'data' => $categoria,
    'options' => ['placeholder' => 'Selecciona una categoria ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);
?>
<?php echo $form->field($model, 'tag')->widget(Select2::className(), [
	'data' => $tags,
	"options" => ['multiple' => true,
		'placeholder' => 'Seleccione una o varias etiquetas...',
	],
])->label('Tags');
?>
<?= Html::submitButton('Buscar', ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end(); ?>
</div>



<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Catalog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="catalog-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'car_id')->dropDownList($model::cars()) ?>

    <?= $form->field($model, 'models')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'engine_type')->dropDownList($model::engineType()) ?>

    <?= $form->field($model, 'drive')->dropDownList($model::drive()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

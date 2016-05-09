<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Authors;
use backend\models\Publisher;

/* @var $this yii\web\View */
/* @var $model backend\models\Books */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="books-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=$form->field($model, 'author_id')->dropDownList(ArrayHelper::map(Authors::find()->asArray()->all(), 'id', 'first_name'), ['prompt'=>'-Choose Authors Name-']) ?>
    
    <?=$form->field($model, 'publisher_id')->dropDownList(ArrayHelper::map(Publisher::find()->asArray()->all(), 'id', 'name'), ['prompt'=>'-Choose a Course-']) ?> 

    <?= $form->field($model, 'isbn')->textInput(['maxlength' => 16]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'year')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

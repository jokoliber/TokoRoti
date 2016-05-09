<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Books;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\BookCopy */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-copy-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?=$form->field($model, 'book_id')->dropDownList(ArrayHelper::map(Books::find()->asArray()->all(), 'id', 'title'), ['prompt'=>'-Choose book Course-']) ?> 
    <?= $form->field($model, 'call_number')->textInput(['maxlength' => 16]) ?>

    <?= $form->field($model, 'year')->textInput(['maxlength' => 4]) ?>

    <?= $form->field($model, 'availability')->textInput() ?>

    <?= $form->field($model, 'loanable')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

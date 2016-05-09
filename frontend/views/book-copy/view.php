<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model frontend\models\BookCopy */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Book Copies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-copy-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'book_id',
            'call_number',
            'year',
            'availability',
            'loanable',
        ],
    ]) ?>



</div>

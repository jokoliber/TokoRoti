<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BookCopySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Book Copies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-copy-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Book Copy', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'book_id',
            'call_number',
            'year',
            'availability',
            // 'loanable',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

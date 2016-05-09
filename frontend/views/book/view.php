<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use frontend\models\Author;

/* @var $this yii\web\View */
/* @var $model frontend\models\Book */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'author.first_name',
            'publisher.name',
            'isbn',
            'title',
            'year',
            'description:ntext',
        ],
    ]) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
            'id',
            'book_id',
            'call_number' ,
            'year' ,
            'availability' ,
            'loanable' ,
            [
                'attribute' => 'Action',
                'format' => 'raw',
                'value' => function ($model) {
                    if($model->availability == 1){return '<div>'. Html::a('Pinjam', [
                        'book/borrow','id'=>$model->id , 'book_id' => $model->book_id],
                        ['class' => 'btn btn-success']).'</div>';
                    }
                else{
                    return "<div ><strong>-</strong></div>";
                }
                    
                },
            ],
        ]
    ])?>

</div>

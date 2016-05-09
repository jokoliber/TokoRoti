<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PublisherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Publishers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publisher-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'email:email',
            'address',
            'phone',

            [
                'attribute' => 'Action',
                'format' => 'raw',
                'value' => function ($model) {
                    return '<div>'. Html::a('View', [
                        'publisher/view','id'=>$model->id],
                        ['class' => 'btn btn-success']).'</div>';
                },
            ],
        ],
    ]); ?>

</div>

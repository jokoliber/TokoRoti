<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Members';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'account_id',
            'first_name',
            'last_name',
            'email:email',
            // 'address',

                        [
                'attribute' => 'Detail',
                'format' => 'raw',
                'value' => function ($model) {
                    return '<div>'. Html::a('view', [
                        'member/view','id'=>$model->id],
                        ['class' => 'btn btn-success']).'</div>';
                },
            ],   
        ],
    ]); ?>

</div>

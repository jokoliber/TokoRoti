<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\LoanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Loans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'book.title',
            'borrower_id',
            //'staff_id',
            'start_date',
            'due_date',
            'return_date',
            'fines',
            [
                'attribute' => 'Action',
                'format' => 'raw',
                'value'=>function($model){
                    if($model->start_date =='0000-00-00' && $model->due_date == NULL && $model->return_date == NULL && $model->fines == '0.00'){                     
                          return '<div>'. Html::a('Approve', ['loan/approve','id'=>$model->id],['class' => 'btn btn-success']).'</div>'. '<div>' . Html::a('Reject',['loan/reject', 'id' => $model->id],['class' => 'btn btn-danger']). '</div>';                                         
                    }
                    else if($model->return_date == NULL && $model->fines == '0.00'){
                        return '<div>'. Html::a('Return', ['loan/return','id'=>$model->id],['class' => 'btn btn-info']).'</div>';
                        
                    }
                    else{
                        return "<div ><strong>-</strong></div>";
                    }
                },

  
            ],
            [
                'attribute' => 'Detail',
                'format' => 'raw',
                'value' => function ($model) {
                    return '<div>'. Html::a('view', [
                        'loan/view','id'=>$model->id],
                        ['class' => 'btn btn-default']).'</div>';
                },
            ],      
        ],
    ]); ?>

</div>

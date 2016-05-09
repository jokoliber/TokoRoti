 <?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Book;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LoanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Loans';
$this->params['breadcrumbs'][] = $this->title;
//works $query = new Query();$query->from('Loan')->where(['borrower_id' =>9])
?>
<div class="loan-index">

    <h1>My <?= Html::encode($this->title) ?></h1>
    <?php
    if($status = 'view'){

    }
    else if ($status == 'success') {
        echo "<div class='alert alert-success'>Your request has been send!</div>";
    } else if ($status == 'cancel') {
        echo "<div class='alert alert-success'>Request has been canceled!</div>";
    } else if ($status == 'toomany') {
        echo "<div class='alert alert-danger'>You cannot request/borrow more than 3 Book Copy!</div>";
    } else if ($status == 'similiar') {
        echo "<div class='alert alert-danger'>Request Failed! Only one Book_Copy can be borrowed! </div>";
    }
    ?>
     <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'Title',
                'value' => function($model) {
                    $book_id = Yii::$app->db->createCommand('SELECT book_id FROM book_copy where id=' . $model->copy_id)
                            ->queryScalar();

                    return Yii::$app->db->createCommand('SELECT title FROM book where id=' . $book_id)
                                    ->queryScalar();
                }
            ],
            'start_date',
            'due_date',
            'return_date',
            'fines',
            [
                'attribute' => 'Status',
                'format' => 'raw',
                'value' => function ($model) {
                    $availability = Yii::$app->db->createCommand('SELECT availability FROM book_copy where id=' . $model->copy_id)
                            ->queryScalar();

                    if ($model->start_date == '0000-00-00' && $model->return_date == NULL && $availability = 1) {
                        return "<div><span class='label label-info'>Request</span></div>";
                    } else if ($model->start_date != '0000-00-00' && $model->return_date != NULL && $availability = 1) {
                        return "<div><span class='label label-default'>Returned</span></div>";
                    } else if ($model->start_date != '0000-00-00' && $model->return_date == NULL) {
                        return "<div><span class='label label-success'>Accepted</span></div>";
                    } else if ($model->start_date == '0000-00-00' && $model->return_date == '0000-00-00' && $model->due_date =='0000-00-00' && $availability = 1) {
                        return "<div><span class='label label-danger'>Rejected</span></div>";
                    }
                },
            ],
            [
                'attribute' => 'Action',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->start_date == '0000-00-00' && $model->due_date == NULL) {
                        return '<div>' . Html::a('Cancel', [
                                    'loan/cancel', 'id' => $model->id, 'copy' => $model->copy_id], [
                                    'class' => 'btn btn-danger',
                                    'data' => [
                                        'confirm' => 'Are you sure you want to cancel this request?',
                                        'method' => 'post',
                                    ],
                                ]) . '</div>';
                    } else{
                        return "<div ><strong>-</strong></div>";
                    }
                },
                    ],
                ],
            ]);
            ?>
</div>
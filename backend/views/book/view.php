<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use backend\models\Publisher;

/* @var $this yii\web\View */
/* @var $model backend\models\Books */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-view">


    <section class="content">
          <div class="row">
            <div class="col-md-12">
             <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
                      <p>
                            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        </p>
                    
                </div><!-- /.box-header -->
                <div class="box-body">
                <div class="col-md-2">                   
                    <img src="<?= "/ibad/Projek Natal/libraryng/advanced/backend/img/book/".$model->id.'.jpg' ?>" width="150" height="350" class="img-responsive" alt="...">
                    <?php //die(Yii::$app->basePath); ?>
                </div>
                <div class="col-md-10">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'author.first_name',
                        'publisher.name',
                        'isbn',
                        'title',
                        'year',
                    ],
                ])?>                    
                </div></div></div></div></div>
        
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
        ]
    ])?>
</section>


</div>

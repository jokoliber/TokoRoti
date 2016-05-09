<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Member */

$this->title = $model->first_name . ' ' . $model->last_name ;
$this->params['breadcrumbs'][] = ['label' => 'Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <section class="content">
          <div class="row">
            <div class="col-md-12">
             <div class="box">
                <div class="box-header with-border">
                  <p> <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-xs']) ?>    </p>
                </div><!-- /.box-header -->
                <div class="box-body">
                <div class="col-md-2">
                    <?php $id = Yii::$app->user->getId(); ?>
                     <img src="<?= "/ibad/Projek Natal/libraryng/advanced/frontend/img/profile/".$id.'.png' ?>" width="150" height="350" class="img-responsive" alt="...">
                    <?php //die(Yii::$app->basePath); ?>
                </div>
                <div class="col-md-10">
              <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'first_name',
            'last_name',
            'email:email',
            'address',
        ],
    ])?>                    
                </div></div></div></div></div></section>>   

</div>

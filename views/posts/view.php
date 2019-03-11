<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */

$this->title = $model->title;
//$this->username=$model->user->username;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="posts-view">

    <!--    <h1>--><? //= Html::encode($this->title) ?><!--</h1>-->
    <h2>Author: <?= Html::encode($model->user->username) ?></h2>


    <!--    <p>-->
    <!--        --><? //= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <!--        --><? //= Html::a('Delete', ['delete', 'id' => $model->id], [
    //            'class' => 'btn btn-danger',
    //            'data' => [
    //                'confirm' => 'Are you sure you want to delete this item?',
    //                'method' => 'post',
    //            ],
    //        ]) ?>
    <!--    </p>-->


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'user_id',
            'id',
            'date_created',
            'date_updated',
            'title',
            'body:ntext',

        ],
    ]) ?>

</div>

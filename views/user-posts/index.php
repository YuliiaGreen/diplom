<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
//print_r($models);
?>
<div class="posts-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php
    foreach ($models as $model):?>
        <div class="col-md-6">
            <?= $model->title; ?>
        </div>
        <p>Автор: <?php echo($model->user->username) ?></p>

        <div class="col-md-6"> Створено:
            <?= $model->date_created; ?>
        </div>
        <div class="col-md-6">
            <?= $model->body; ?>
        </div>
    <?php
    endforeach; ?>

</div>

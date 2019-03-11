<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>


<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a('Create Posts', ['create'], ['class' => 'btn btn-success']) ?>
</p>

<!--    --><?php //print_r($model);
//     GridView::widget([
//            'dataProvider' => $models,
//            'columns' => [
//                ['class' => 'yii\grid\SerialColumn'],
//
//                'id',
//                'user_id',
//                'date_created',
//                'date_updated',
//                'body:ntext',
//                'title',
//
//                ['class' => 'yii\grid\ActionColumn'],
//            ],
//        ]);
//
//    ?>
<!--<div class="col-md-10"-->
<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">#</th>
        <th scope="col">Автор</th>
        <th scope="col">Заголовок</th>
        <th scope="col">Текст</th>
        <th scope="col">Дата створення</th>
        <th scope="col">Редагувати</th>
        <th scope="col">Видалити</th>
        <th scope="col">Переглянути</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($models as $model):?>
        <tr>
            <th scope="row">1</th>
            <td scope="col"><?php echo($model->user->username) ?></td>
            <td scope="col"><?php echo($model->title) ?></td>
            <td scope="col"><?php echo($model->body) ?></td>
            <td scope="col"><?php echo($model->date_created) ?></td>
            <!--            <td  scope="col"><a href="update?id=--><?php //echo ($model->id)
            ?><!--" >Edit</a></td>-->
            <td scope="col"> <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?> </td>
            <td scope="col">  <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?></td>
            <td scope="col"><a href="view?id=<?php echo($model->id) ?>">View</a></td>
            <!--            <td>@mdo</td>-->
        </tr>
    <?php
    endforeach; ?>
    </tbody>
</table>
</div.table>

<!--    --><? //= $model->title; ?>
<!--</div>-->
<!---->
<!--        <div class="col-md-6"> Створено:-->
<!--            --><? //= $model->date_created; ?>
<!--        </div>-->
<!--        <div class="col-md-6">-->
<!--            --><? //= $model->body; ?>
<!--        </div>-->

</div>

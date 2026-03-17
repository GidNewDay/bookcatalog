<?php

/** @var yii\web\View $this */
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use common\models\Book;
use yii\widgets\ListView;

/** @var common\models\search\BookSearch $searchModel */
$this->title = 'Каталог книг';
?>
<div class="site-index">
    <div class="jumbotron text-center bg-light p-5 mb-4">
        <h1>Добро пожаловать в каталог книг!</h1>
        <p class="lead">Здесь вы можете найти информацию о книгах и авторах.</p>
    </div>

    <div class="body-content">
        <h2>Последние книги</h2>
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => function ($model, $key, $index, $widget) {
                return Html::a(Html::encode($model->title), ['book/view', 'id' => $model->id]);
            },
            'summary' => false,
            'emptyText' => 'Книг пока нет.',
        ]) ?>
    </div>
</div>
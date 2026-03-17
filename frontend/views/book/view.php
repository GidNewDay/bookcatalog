<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Book $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="book-view">

    <?php if ($model->cover_image): ?>
        <div class="book-cover">
            <?= Html::img('/' . $model->cover_image, ['style' => 'max-width:300px;']) ?>
        </div>
    <?php endif; ?>

    <div class="book-details">
        <h1><?= Html::encode($model->title) ?></h1>
        <p><strong>Год выпуска:</strong> <?= $model->year ?></p>
        <p><strong>ISBN:</strong> <?= Html::encode($model->isbn) ?></p>
        <p><strong>Описание:</strong><br> <?= nl2br(Html::encode($model->description)) ?></p>
        <p><strong>Авторы:</strong></p>
        <ul>
            <?php foreach ($model->authors as $author): ?>
                <li><?= Html::a($author->full_name, ['author/view', 'id' => $author->id]) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <?php if (!Yii::$app->user->isGuest && Yii::$app->user->can('user')): ?>
        <p>
            <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите удалить эту книгу?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    <?php endif; ?>

</div>
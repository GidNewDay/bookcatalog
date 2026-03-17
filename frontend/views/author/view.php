<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Author $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="author-view">
    <h1><?= Html::encode($model->full_name) ?></h1>

    <h3>Книги этого автора:</h3>
    <?= ListView::widget([
        'dataProvider' => new \yii\data\ActiveDataProvider([
            'query' => $model->getBooks(),
            'pagination' => ['pageSize' => 10],
        ]),
        'itemView' => function ($book) {
            return Html::a($book->title, ['book/view', 'id' => $book->id]);
        },
        'summary' => false,
    ]) ?>
</div>

<div class="subscription-form">
    <h3>Подписаться на новые книги автора</h3>
    <?php $form = ActiveForm::begin(['action' => ['author/subscribe', 'id' => $model->id], 'method' => 'post']); ?>

    <?= $form->field(new \common\models\Subscription(), 'phone')->textInput(['placeholder' => '+7XXXXXXXXXX'])->label('Ваш номер телефона') ?>

    <div class="form-group">
        <?= Html::submitButton('Подписаться', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
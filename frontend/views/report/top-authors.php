<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

$this->title = 'ТОП-10';
?>

<div class="report-top-authors">
    <h1>Топ 10 авторов по количеству книг</h1>

    <div class="row">
        <div class="col-md-4">
            <?php $form = ActiveForm::begin(['method' => 'get']); ?>
            <?= Html::dropDownList('year', $selectedYear, array_combine($years, $years), [
                'class' => 'form-control',
                'prompt' => 'Выберите год'
            ]) ?>
            <div class="form-group mt-2">
                <?= Html::submitButton('Показать', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <div class="mt-4">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'full_name:text:Автор',
                'book_count:integer:Количество книг',
            ],
            'emptyText' => 'За выбранный год книг не найдено.',
        ]); ?>
    </div>
</div>
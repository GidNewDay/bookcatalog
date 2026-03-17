<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Book $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="book-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'year')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'isbn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'authorIds')->checkboxList(
        \yii\helpers\ArrayHelper::map(\common\models\Author::find()->all(), 'id', 'full_name')
    ) ?>
    
    <?//= $form->field($model, 'cover_image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'coverFile')->fileInput(['accept' => 'image/*']) ?>

    <?php if (!$model->isNewRecord && $model->cover_image) {?>  
    <?= Html::img('/' . $model->cover_image, ['style' => 'max-width:200px; max-height:200px;']); ?>
    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    
    
    <?php ActiveForm::end(); ?>

</div>

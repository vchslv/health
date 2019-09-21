<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>
                                      <!-- подставляем значения из action -->
    <?= Html::dropDownList('category', $selectedCategory, $categories, ['class'=>'form-control']) ?>


    <div class="form-group">
        <!-- отправка формы при клике -->
        <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

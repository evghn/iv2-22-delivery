<?php

use app\models\Category;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Product2Search $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'id' => 'form-product-search',
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>


    <div class="d-flex justify-content-start align-items-end gap-3">

        <?= $form->field($model, 'title') ?>
        <?= $form->field($model, 'title_search')->hiddenInput()->label(false) ?>


        <?= $form->field($model, 'category_id')->dropDownList(Category::getCategories(), [
            'prompt' => 'Выберете категорию'
        ]) ?>

        <div class="form-group">
            <?= Html::a('Reset', '/', ['class' => '']) ?>
        </div>
        
        
    </div>

    <?php ActiveForm::end(); ?>

</div>
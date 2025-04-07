<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\web\JqueryAsset;

/** @var yii\web\View $this */
/** @var app\models\Item $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="item-form">

    <?php $form = ActiveForm::begin([
        'id' => 'form-item'
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>
<p>
    свойства:
</p>

    <div id="block-props">
        <?php foreach ($props  as $key => $prop): ?>
            <div class="border p-3 my-3 item-props" data-index="<?= $key ?>">
                <div class="d-flex justify-content-end">
                    <div class="btn-group " role="group" aria-label="Basic mixed styles example">
                        <button type="button" class="btn btn-danger btn-remove">-</button>                   
                        <button type="button" class="btn btn-success btn-pluse">+</button>
                    </div>                    
                </div>
                <div class="flex">
                    <?= $form->field($prop, "[$key]title")->textInput(['maxlength' => true]) ?>
                    <?= $form->field($prop, "[$key]value")->textInput() ?>
                    <?= $form->field($prop, "[$key]id")->hiddenInput()->label(false) ?>
                </div>
            </div>
        <?php endforeach ?>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

$this->registerJsFile('/js/props.js', ['depends' => JqueryAsset::class]);

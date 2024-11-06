<?php

use yii\helpers\Html;
use yii\helpers\VarDumper;

/** @var yii\web\View $this */
/** @var app\models\Category $model */

$this->title = 'Редактирование категории: ' . $model->title;

// VarDumper::dump($this, 10, true); die;

?>
<div class="category-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

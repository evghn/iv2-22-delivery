<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Order $model */

$this->title = 'Создание заказа';
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
        'payTypes' => $payTypes,
        'outposts' => $outposts,
    ]) ?>

</div>

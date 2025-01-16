<?php

use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\modules\account\models\FavouriteSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Избранное';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="favourite-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <?php Pjax::begin([
        'id' => 'favourite-pjax',
        'enablePushState' => false,
        'timeout' => 5000,
    ]); ?>

    <div>
         <?= $dataProvider->sort->link('product_category') ?>
    </div>

    <?= $this->render('_search', [
        'model' => $searchModel,
        'categories' => $categories,
    ]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'layout' => "{pager}\n{summary}\n<div class='d-flex flex-wrap gap-3 justify-content-center mt-3 catalog'>{items}</div>\n{pager}",
        'pager' => [
            'class' => LinkPager::class,
        ],
        // ver 1
        // 'itemView' => function ($model, $key, $index, $widget) {
        //     return Html::a(Html::encode($model->title), ['view', 'id' => $model->id]);
        // },
        'itemView' => 'item'        
    ]) ?>
    

    <?php Pjax::end(); ?>

</div>

<?php
    $this->registerJsFile('/js/favourite.js', ['depends' => JqueryAsset::class]);
?>

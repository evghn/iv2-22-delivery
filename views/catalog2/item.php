<?php

use yii\bootstrap5\Html;
?>

<div class="card" style="width: 18rem;">
  <!-- <img src="..." class="card-img-top" alt="..."> -->
   <?= Html::a(Html::img('/img/' . ($model->photo ?? $model::NO_PHOTO), ['alt' => 'photo', 'class' => "card-img-top"]), ['view', 'id' => $model->id], ['class' => ""]) ?>
  <div class="card-body">    
    <h5 class="card-title">
        <?= Html::a(Html::encode($model->title), ['view', 'id' => $model->id], ['class' => "text-decoration-none"]) ?>
    </h5>
    <p class="card-text"><?= $model->category->title ?> </p>
    <div>
      <div class="d-flex justify-content-between">
        
        <div class='gap-3'>
          <!-- 👍🏻 -->
          <?= (! Yii::$app->user->isGuest && ! Yii::$app->user->identity->isAdmin)
                ? Html::a("👍(<span class='text-success like-count'>$model->like</span>)", ['reaction-client', 'id' => $model->id, 'reaction' => 'like'], ['class' => 'text-decoration-none btn-like']) 
                : ""
                ?>
            <?= (! Yii::$app->user->isGuest && ! Yii::$app->user->identity->isAdmin)
                ? Html::a("👎(<span class='text-danger dislike-count'>$model->dislike</span>)", ['reaction-client', 'id' => $model->id, 'reaction' => 'dislike'], ['class' => 'text-decoration-none btn-dislike'])
                : ""
                ?>
            <?= (! Yii::$app->user->isGuest && ! Yii::$app->user->identity->isAdmin)
                ? Html::a(
                  empty($model->favourites[0]->status)
                  ? '🤍'
                  : '❤'
                  , ['reaction-client', 'id' => $model->id, 'reaction' => 'favourite'], ['class' => 'text-decoration-none btn-favourite']) 
                  : ""
                  ?>
        </div>
        <?= Html::a('Просмотр', ['view', 'id' => $model->id], ['class' => "btn btn-outline-primary"]) ?>
      </div>    


        <?= !Yii::$app->user->isGuest && !Yii::$app->user->identity->isAdmin
          ? Html::a('Заказать', ['/account/order/create', 'product_id' => $model->id], ['class' => "btn btn-outline-success w-100 mt-2", 'data-pjax' => 0])
          : "" ?>
        <?= !Yii::$app->user->isGuest && !Yii::$app->user->identity->isAdmin
          ? Html::a('Заказать вариант 2', ['/account/order/create2', 'product_id' => $model->id], ['class' => "btn btn-outline-success w-100 mt-2", 'data-pjax' => 0])
          : '' ?>

        <?= !Yii::$app->user->isGuest && !Yii::$app->user->identity->isAdmin
          ? Html::a('Заказать вариант 3', ['/account/order/create3', 'product_id' => $model->id], ['class' => "btn btn-outline-success w-100 mt-2", 'data-pjax' => 0])
          : '' ?>
          
        
    </div>
  </div>
</div>
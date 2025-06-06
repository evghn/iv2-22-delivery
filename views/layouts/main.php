<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Modal;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\web\JqueryAsset;
use yii\widgets\Pjax;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        // 'brandLabel' => '<img src="/img/noImage.png" style="width: 50px"> my company',
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md color-panel fixed-top', 'data-bs-theme' => "dark"]
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => 'Каталог', 'url' => ['/catalog2']],
            ['label' => 'Каталог light', 'url' => ['/catalog']],
            ['label' => 'dynamic', 'url' => ['/dmf']],
            //['label' => 'Contact', 'url' => ['/site/contact']],
            //['label' => 'my page', 'url' => ['/my-first/hello']],

            Yii::$app->user->isGuest
                ? ['label' => 'Регистрация', 'url' => ['/site/register']]
                : '',
            
            !Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin
                ? ['label' => 'Панель управления', 'url' => ['/admin-panel']]
                : '',
            
            !Yii::$app->user->isGuest && !Yii::$app->user->identity->isAdmin
                ? ['label' => 'Личный кабинет', 'url' => ['/account']]
                : '',
            Yii::$app->user->isGuest
                ? ['label' => 'Панель управления', 'url' => ['/admin-panel/login']]
                : '',
            ['label' => 'Почта', 'url' => ['/site/mail']],
                
            Yii::$app->user->isGuest
                ? ['label' => 'Вход', 'url' => ['/site/login']]
                : '<li class="nav-item">'
                    . Html::beginForm(['/site/logout'])
                    . Html::submitButton(
                        'Выход (' . Yii::$app->user->identity->login . ')',
                        ['class' => 'nav-link btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
        ]
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <!-- return render view file --> 
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-12 text-center text-md-end">&copy; Delivery <?= date('Y') ?></div>            
        </div>
    </div>
</footer>

<div class="toast-container position-fixed top-5 end-0 p-3" >
    <div class="toast bg-warning text-dark border-0 top-5 end-0 bg-opacity-75 fs-5" role="status" aria-live="polite" aria-atomic="true" id="t2"  data-bs-autohide="true" data-bs-delay= '5000' >
        <div class="d-flex">
            <div class="toast-body">
                Привет, мир! Это тост-сообщение.
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Закрыть"></button>
        </div>
    </div>
</div>
<?php

    // Yii::debug($this->params);

    if (isset($this->params['order'])) {
        $this->registerJsFile('/js/cancel-modal2.js', ['depends' => JqueryAsset::class]);

        Modal::begin([
                'id' => 'cancel-modal2',
                'title' => 'Отмена заказа',
                'size' => 'modal-lg'
            ]);    
            // Pjax::begin([
            //     'id' => 'form-cancel-pjax2',
            //     'enablePushState' => false,
            //     'timeout' => 5000,
            //     'options' => [
            //         'data-first-load' => 1
            //     ]
            // ]);
                echo $this->render('@app/modules/admin/views/order/form-modal2', [
                    'model_cancel' => $this->params['order']['model']
                ]);    
            // Pjax::end();
    
        Modal::end();
    }
?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

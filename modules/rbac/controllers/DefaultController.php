<?php

namespace app\modules\rbac\controllers;

use yii\web\Controller;

/**
 * Default controller for the `rbac` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionCreate()
    {
        echo 'ok';
    }
}

<?php

namespace app\modules\dmf\controllers;

use yii\web\Controller;
// use yii\httpclient

/**
 * Default controller for the `dmf` module
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


    public function actionHttp()
    {

        // $client = new \yii\httpclient\Client;
    }
}

<?php

namespace app\controllers;

use app\models\MyModel;
use Symfony\Component\VarDumper\VarDumper as VarDumper;
use yii\web\Controller;

class MyFirstController extends Controller
{

    public function actionHello()
    {
        $data = MyModel::getImage();
        return $this->render('index', compact('data'));
    }


    public function actionHelloUser()
    {
        $user = 'Vasya';

        // version 1
        // return $this->render('hello', [
        //     'user' => $user
        // ]);

        // ver. 2
        return $this->render('hello', compact('user'));

    }

    public function actionTest()
    {
        VarDumper::dump('apple');
        VarDumper::dump(strlen('apple'));
        VarDumper::dump('яблоко яблоко');
        VarDumper::dump(mb_strlen('яблоко яблоко'));
        die;
    }

}

<?php
// var_dump($_SERVER); die;

if ($_SERVER["DOCUMENT_ROOT"] == 'E:/OSPanel/domains/iv2-22-delivery') {
    return [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;port=3306;dbname=delivery_22',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',        
    ];
    
}

if ((isset($_SERVER["SERVER_ADDR"]) && $_SERVER["SERVER_ADDR"] != '127.0.0.1') || (isset($_SERVER['SERVER_PORT']) &&  $_SERVER['SERVER_PORT'] = '8080')) {
     return [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=MySQL-8.2;port=3306;dbname=delivery_22',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',        
    ];
}

return  [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;port=33061;dbname=delivery_22',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8', 
    // 'tablePrefix' => 'delivery_22'       
];

<?php
namespace app\models;

use yii\base\Model;

class MyModel extends Model
{

    public static function getImage()
    {
        $data = [
            'milk.jpg',
            'noImage.png'
        ];

        return $data;
    }
}

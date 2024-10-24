<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $title
 * @property string $photo
 * @property float $price
 * @property int $count
 * @property int $like
 * @property int $dislike
 * @property float|null $weight
 * @property float|null $kilocalories
 * @property string|null $shelf_life
 * @property string $description
 * @property int $category_id
 *
 * @property Category $category
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'photo', 'price', 'description', 'category_id'], 'required'],
            [['price', 'weight', 'kilocalories'], 'number'],
            [['count', 'like', 'dislike', 'category_id'], 'integer'],
            [['description'], 'string'],
            [['title', 'photo', 'shelf_life'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'photo' => 'Photo',
            'price' => 'Price',
            'count' => 'Count',
            'like' => 'Like',
            'dislike' => 'Dislike',
            'weight' => 'Weight',
            'kilocalories' => 'Kilocalories',
            'shelf_life' => 'Shelf Life',
            'description' => 'Description',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item_prop".
 *
 * @property int $id
 * @property string $title
 * @property int $value
 * @property int $item_id
 *
 * @property Item $item
 */
class ItemProp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item_prop';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'value','item_id'], 'required'],
            [['value', 'item_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::class, 'targetAttribute' => ['item_id' => 'id']],
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
            'value' => 'Value',
            'item_id' => 'Item ID',
        ];
    }

    /**
     * Gets query for [[Item]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::class, ['id' => 'item_id']);
    }
}

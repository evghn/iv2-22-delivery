<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;
use Yii;

/**
 * Product10Search represents the model behind the search form of `app\models\Product`.
 */
class Product10Search extends Product
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'count', 'like', 'dislike', 'category_id'], 'integer'],
            [['title', 'photo', 'shelf_life', 'description'], 'safe'],
            [['price', 'weight', 'kilocalories'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Product::find()
                    // ->innerJoin(['q' => 
                    //     Product::find()
                    //         ->orderBy(['like' => SORT_DESC])
                    //         -> limit(10)
                    //     ], 'product.id = q.id')
                    ;
                            
        

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,                
            ],
            'sort' => [
                'defaultOrder' => [
                    'like' => SORT_DESC, 
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            // 'id' => $this->id,
            'id' => Product::find()->select('id')->orderBy(['like' => SORT_DESC])->limit(10)->column(),
            'price' => $this->price,
            'count' => $this->count,
            'like' => $this->like,
            'dislike' => $this->dislike,
            'weight' => $this->weight,
            'kilocalories' => $this->kilocalories,
            'category_id' => $this->category_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'shelf_life', $this->shelf_life])
            ->andFilterWhere(['like', 'description', $this->description]);

    
        Yii::debug($query->createCommand()->rawSql);     
        return $dataProvider;
    }
}

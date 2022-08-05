<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Catalog;

/**
 * CatalogSearch represents the model behind the search form of `common\models\Catalog`.
 */
class CatalogSearch extends Catalog
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'car_id', 'engine_type', 'drive', 'status', 'created_at', 'updated_at'], 'integer'],
            [['car_grid_id'], 'string', 'max' => 255],
            [['models'], 'safe'],
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
        $query = Catalog::find()->leftJoin('cars', 'catalog.car_id=cars.id');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'catalog.id' => $this->id,
            'catalog.car_id' => $this->car_id,
            'catalog.engine_type' => $this->engine_type,
            'catalog.drive' => $this->drive,
            'catalog.status' => $this->status,
            'catalog.created_at' => $this->created_at,
            'catalog.updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['ilike', 'catalog.models', $this->models]);
        $query->andFilterWhere(['ilike', 'cars.brand', $this->car_grid_id]);

        return $dataProvider;
    }
}

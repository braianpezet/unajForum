<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Etiqueta_post;

/**
 * Etiqueta_postSearch represents the model behind the search form of `app\models\Etiqueta_post`.
 */
class Etiqueta_postSearch extends Etiqueta_post
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_etiqueta', 'id_post'], 'integer'],
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
        $query = Etiqueta_post::find();

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
            'id_etiqueta' => $this->id_etiqueta,
            'id_post' => $this->id_post,
        ]);

        return $dataProvider;
    }
}

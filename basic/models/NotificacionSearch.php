<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Notificacion;

/**
 * NotificacionSearch represents the model behind the search form of `app\models\Notificacion`.
 */
class NotificacionSearch extends Notificacion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'ID_USER_EMISOR', 'ID_USER_RECEPTOR'], 'integer'],
            [['NOTIFICACION', 'FECHA'], 'safe'],
            [['visto'], 'boolean'],
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
        $query = Notificacion::find();

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
            'ID' => $this->ID,
            'ID_USER_EMISOR' => $this->ID_USER_EMISOR,
            'ID_USER_RECEPTOR' => $this->ID_USER_RECEPTOR,
            'FECHA' => $this->FECHA,
            'visto' => $this->visto,
        ]);

        $query->andFilterWhere(['like', 'NOTIFICACION', $this->NOTIFICACION]);

        return $dataProvider;
    }
}

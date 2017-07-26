<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Apple;

/**
 * AppleSearch represents the model behind the search form about `common\models\Apple`.
 */
class AppleSearch extends Apple
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['created_at', 'fall_at'], 'match', 'pattern' => "/\d{2}\.\d{2}\.\d{4}/"],
            [['color', 'status'], 'safe'],
            [['size'], 'number'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Apple::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
        ]);

        $this->load($params);


        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'size' => $this->size,
        ]);



        if($this->created_at){
            list($dateObjFrom, $dateObjTo)=$this->getDatesObj($this->created_at);
            $query->andWhere(['between','created_at', $dateObjFrom->getTimestamp(),$dateObjTo->getTimestamp()]);
        }

        if($this->fall_at){
            list($dateObjFrom, $dateObjTo)=$this->getDatesObj($this->fall_at);
            $query->andWhere(['between','fall_at', $dateObjFrom->getTimestamp(),$dateObjTo->getTimestamp()]);
        }

        $query->andFilterWhere(['like', 'color', $this->color])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }

    function getDatesObj($date){
        $dateObjFrom=\DateTime::createFromFormat('d.m.Y H:i:s',$date." 00:00:00");
        $dateObjTo=\DateTime::createFromFormat('d.m.Y H:i:s',$date." 23:59:59");
        return [$dateObjFrom,$dateObjTo];
    }
}

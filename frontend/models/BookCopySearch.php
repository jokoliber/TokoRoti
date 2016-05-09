<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\BookCopy;

/**
 * BookCopySearch represents the model behind the search form about `frontend\models\BookCopy`.
 */
class BookCopySearch extends BookCopy
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'book_id', 'availability', 'loanable'], 'integer'],
            [['call_number', 'year'], 'safe'],
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
        $query = BookCopy::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'book_id' => $this->book_id,
            'availability' => $this->availability,
            'loanable' => $this->loanable,
        ]);

        $query->andFilterWhere(['like', 'call_number', $this->call_number])
            ->andFilterWhere(['like', 'year', $this->year]);

        return $dataProvider;
    }
}

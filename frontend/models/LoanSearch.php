<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Loan;

/**
 * LoanSearch represents the model behind the search form about `frontend\models\Loan`.
 */
class LoanSearch extends Loan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'copy_id', 'borrower_id', 'staff_id'], 'integer'],
            [['start_date', 'due_date', 'return_date'], 'safe'],
            [['fines'], 'number'],
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
        $query = Loan::find();

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
            'copy_id' => $this->copy_id,
            'borrower_id' => $this->borrower_id,
            'staff_id' => $this->staff_id,
            'start_date' => $this->start_date,
            'due_date' => $this->due_date,
            'return_date' => $this->return_date,
            'fines' => $this->fines,
        ]);

        return $dataProvider;
    }
}

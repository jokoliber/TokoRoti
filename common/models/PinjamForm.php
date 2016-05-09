<?php     
namespace common\models;

use Yii;
use yii\base\Model;
use frontend\models\Loan;

class RegistrationForm extends Model {
        public $copy_id;
        public $borrowed_id;

    public function rules(){
        return [

            [['copy_id', 'borrowed_id'], 'required' , ],
        ];
    }

    public function attributeLabels(){
        return [
        'copy_id' => 'Book Loan ID',
        'borrowed_id' => 'Borrowed ID',
        ];
    }



    public function scenarios(){
        $scenario = parent::scenarios();
        $scenario['register'] = ['copy_id', 'borrowed_id'];
        return $scenario;
    }

    public function pinjam(){
        if ($this->validate()) //rules harus dijalankan]       
        {
            $loan = new loan();
            $loan->copy_id = $this->copy_id;
            $loan->borrowed_id = $this->borrowed_id;
            $loan->save();
        }
         return false;
    }
}
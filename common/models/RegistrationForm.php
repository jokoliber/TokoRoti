<?php     
namespace common\models;

use Yii;
use yii\base\Model;
use frontend\models\Account;
use frontend\models\Member;
use frontend\models\AuthAssignment;

class RegistrationForm extends Model {
        public $first_name;
        public $last_name;
        public $address;
        public $email;
        //public $date_of_birth;
        //public $sex;
        public $username;
        public $password;
        public $repassword;

    public function rules(){
        return [

            //[['username', 'password', 'email'], 'required' , ],
            [['username', 'password', 'email' , 'first_name', 'last_name' , 'address' , 'repassword'], 'required' , 'on' =>'register' , 'message' =>'Inputan tidak boleh kosong'],
            ['password' , 'validatePassword'],
            //[['is_staff'], 'integer'],
            [['username'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 255],
            ['email','email'],
            ['email', 'filter', 'filter' => 'trim'],
            ['username', 'unique', 'targetClass' => '\frontend\models\Account' , 'message' => 'username already exist'],
            ['email', 'unique', 'targetClass' => '\frontend\models\Member' , 'message' => 'username already exist'],
            //username should consist of lowercase alphabetic
            ['username', 'match' , 'pattern' => '/^[a-z]\w*$/i '],
            //password comparison
            //[['password'], 'compare' , 'compareValue' => 'bintang15', 'message' => Yii::t('app', 'The Password must match')],
            //[['repassword'], 'string', 'max' => 10],
            [['repassword'], 'compare', 'compareAttribute'=>'password' , 'message'=>Yii::t('app', 'The Password must match')],
            //[['date_of_birth'], 'date', 'format'=>'yyyy-mm-dd'],
            [['first_name', 'last_name'], 'string', 'max' => 16],
            [['address','email'], 'string', 'max' => 64],
           // [['sex'], 'string', 'max' => 1]
        ];
    }

    public function attributeLabels(){
        return [
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'address' => 'Address',
        'email' => 'Email',
        //'date_of_birth' => 'Date Of Birth', 
        //'sex' => 'Sex',
        'username' => 'Username',
        'password' => 'Password',
        'repassword' => 'Retype Password',
        ];
    }

    public function validatePassword(){
        $pass = $this->password;
        if(strlen($pass)<8){
            $this->addError('password' , 'Password minimal memiliki 8 karakter.');
        }
    }

/*
    public function scenarios(){
        $scenario = parent::scenarios();
        $scenario['register'] = ['username', 'password', 'email' , 'first_name', 'last_name' , 'address', 'repassword'];
        return $scenario;
    }
*/
    public static function hashPassword($_password){
        return (Yii::$app->getSecurity()->generatePasswordHash($_password));
    }

    public function register(){
        if ($this->validate()) //rules harus dijalankan]       
        {
            $account = new Account();
            $account->username = $this->username;
            $account->password = self::hashPassword($this->password);
            //$this->validatePassword();
            //$account->setPassword($this->password);
            //$member->generateAuthKey();

            if($account->save()){
            //transaction begin
                $member = new Member();
                $assign = new AuthAssignment;
                $member->account_id = $account->id ;
                $member->first_name = $this->first_name;
                $member->last_name = $this->last_name;
                $member->address = $this->address;
                $member->email = $this->email;
                

                    if ($member->save()) {
                        $assign = new AuthAssignment;
                        $assign->user_id = $account->id;
                        $assign->item_name = 'member';
                    
                    if ($assign->save()) {   
                        return $member; 
                    }
                    else{
                        print_r($assign->errors);
                    }
                    }
                    else{
                        print_r($member->errors);
                    }
            }
            else{
                print_r($account->errors);
            }
        }
         return false;
    }
}
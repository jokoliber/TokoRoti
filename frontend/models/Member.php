<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "members".
 *
 * @property string $id
 * @property string $account_id
 * @property string $first_name
 * @property string $last_name
 * @property string $address
 * @property string $photograph
 * @property string $email
 * @property string $date_of_birth
 * @property string $sex
 *
 * @property Accounts $account
 */
class Member extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'member';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id'], 'integer'],
            //[['date_of_birth'], 'safe'],
            [['first_name', 'last_name'], 'string', 'max' => 16],
            [['address', 'email'], 'string', 'max' => 64],
            //[['sex'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'account_id' => 'Account ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'address' => 'Address',
            //'photograph' => 'Photograph',
            'email' => 'Email',
            //'date_of_birth' => 'Date Of Birth',
            //'sex' => 'Sex',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Accounts::className(), ['id' => 'account_id']);
    }
}

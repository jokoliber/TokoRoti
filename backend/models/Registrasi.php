<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "members".
 *
 * @property string $id
 * @property string $account_id
 * @property string $code
 * @property string $first_name
 * @property string $last_name
 * @property string $address
 * @property string $email
 * @property string $date_of_birth
 * @property string $sex
 *
 * @property Accounts $account
 */
class Registrasi extends \yii\db\ActiveRecord
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
            [['email'], 'required'],
            [['first_name', 'last_name'], 'string', 'max' => 16],
            [['address'], 'string', 'max' => 64],
            [['email'], 'string', 'max' => 25],
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
            'email' => 'Email',
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

<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "loan".
 *
 * @property string $id
 * @property string $copy_id
 * @property string $borrower_id
 * @property string $staff_id
 * @property string $start_date
 * @property string $due_date
 * @property string $return_date
 * @property double $fines
 *
 * @property Member $borrower
 * @property BookCopy $copy
 * @property Member $staff
 */
class Loan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'loan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['copy_id', 'borrower_id', 'start_date'], 'required'],
            [['copy_id', 'borrower_id', 'staff_id'], 'integer'],
            [['start_date', 'due_date', 'return_date'], 'safe'],
            [['fines'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'copy_id' => 'Copy ID',
            'borrower_id' => 'Borrower ID',
            'staff_id' => 'Staff ID',
            'start_date' => 'Start Date',
            'due_date' => 'Due Date',
            'return_date' => 'Return Date',
            'fines' => 'Fines',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBorrower()
    {
        return $this->hasOne(Member::className(), ['id' => 'borrower_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCopy()
    {
        return $this->hasOne(BookCopy::className(), ['id' => 'copy_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaff()
    {
        return $this->hasOne(Member::className(), ['id' => 'staff_id']);
    }
}

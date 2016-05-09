<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "book_copy".
 *
 * @property string $id
 * @property string $book_id
 * @property string $call_number
 * @property string $year
 * @property integer $availability
 * @property integer $loanable
 *
 * @property Book $book
 * @property Loan[] $loans
 */
class BookCopy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'book_copy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['book_id', 'call_number'], 'required'],
            [['book_id', 'availability', 'loanable'], 'integer'],
            [['call_number'], 'string', 'max' => 16],
            [['year'], 'string', 'max' => 4]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'book_id' => 'Book ID',
            'call_number' => 'Call Number',
            'year' => 'Year',
            'availability' => 'Availability',
            'loanable' => 'Loanable',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::className(), ['id' => 'book_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoans()
    {
        return $this->hasMany(Loan::className(), ['copy_id' => 'id']);
    }
}

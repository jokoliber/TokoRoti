<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property string $id
 * @property string $author_id
 * @property string $publisher_id
 * @property string $isbn
 * @property string $title
 * @property integer $year
 *
 * @property BookCategory[] $bookCategories
 * @property Authors $author
 * @property Publishers $publisher
 */
class Books extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author_id', 'publisher_id', 'year'], 'integer'],
            [['isbn'], 'string', 'max' => 16],
            [['title'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_id' => 'Author ID',
            'publisher_id' => 'Publisher ID',
            'isbn' => 'Isbn',
            'title' => 'Title',
            'year' => 'Year',
            'description' => 'Description'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookCategories()
    {
        return $this->hasMany(BookCategory::className(), ['book_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Authors::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublisher()
    {
        return $this->hasOne(Publisher::className(), ['id' => 'publisher_id']);
    }
}

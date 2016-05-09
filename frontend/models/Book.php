<?php

namespace frontend\models;

use Yii;
use backend\models\Publisher;

/**
 * This is the model class for table "book".
 *
 * @property string $id
 * @property string $author_id
 * @property string $publisher_id
 * @property string $isbn
 * @property string $title
 * @property string $year
 * @property string $description
 *
 * @property Author $author
 * @property Publisher $publisher
 * @property BookCopy[] $bookCopies
 */
class Book extends \yii\db\ActiveRecord
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
            [['author_id', 'publisher_id'], 'integer'],
            [['description'], 'string'],
            [['isbn'], 'string', 'max' => 16],
            [['title'], 'string', 'max' => 64],
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
            'author_id' => 'Author ID',
            'publisher_id' => 'Publisher ID',
            'isbn' => 'Isbn',
            'title' => 'Title',
            'year' => 'Year',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublisher()
    {
        return $this->hasOne(Publisher::className(), ['id' => 'publisher_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookCopies()
    {
        return $this->hasMany(BookCopy::className(), ['book_id' => 'id']);
    }
}

<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;
/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property string $title
 * @property int $year
 * @property string|null $description
 * @property string|null $isbn
 * @property string|null $cover_image
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Author[] $authors
 */
class Book extends \yii\db\ActiveRecord
{

    public $authorIds;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    public $coverFile; // для загрузки файла
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'year'], 'required'],
            [['year'], 'integer', 'max' => date('Y')],
            [['title'], 'string', 'max' => 255],
            [['isbn'], 'string', 'max' => 20],
            [['isbn'], 'unique', 'message' => 'Такой ISBN уже был использован.'],
            [['cover_image'], 'string', 'max' => 255],
            [['description'], 'string'],
            [['authorIds'], 'safe'], // разрешаем массив
            [['coverFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'maxSize' => 10 * 1024 * 1024], // 10 MB
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'year' => 'Year',
            'description' => 'Description',
            'isbn' => 'Isbn',
            'cover_image' => 'Cover Image',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Authors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthors()
    {
        return $this->hasMany(Author::class, ['id' => 'author_id'])->viaTable('{{%book_author}}', ['book_id' => 'id']);
    }

}

<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "subscriptions".
 *
 * @property int $id
 * @property int $author_id
 * @property string $phone
 * @property int|null $created_at
 *
 * @property Author $author
 */
class Subscription extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subscriptions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author_id', 'phone'], 'required'],
            [['author_id'], 'integer'],
            [['phone'], 'string', 'max' => 20],
            [['phone'], 'unique', 'targetAttribute' => ['author_id', 'phone'], 'message' => 'Вы уже подписаны на этого автора.'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_id' => 'Author ID',
            'phone' => 'Phone',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::class, ['id' => 'author_id']);
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => false,
                'value' => time(),
            ],
        ];
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%subscriptions}}`.
 */
class m260317_062207_create_subscriptions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%subscriptions}}', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer()->notNull(),
            'phone' => $this->string(20)->notNull(),
            'created_at' => $this->integer(),
        ]);

        // индекс для быстрого поиска по телефону
        $this->createIndex('idx-subscriptions-phone', '{{%subscriptions}}', 'phone');
        
        // уникальность пары автор-телефон
        $this->createIndex('idx-subscriptions-author-phone', '{{%subscriptions}}', ['author_id', 'phone'], true);

        // внешние ключи
        $this->addForeignKey(
            'fk-subscriptions-author_id',
            '{{%subscriptions}}',
            'author_id',
            '{{%authors}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%subscriptions}}');
    }
}

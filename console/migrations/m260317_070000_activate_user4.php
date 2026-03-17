<?php

use yii\db\Migration;

/**
 * Activates the existing user "user4" so they can log in.
 */
class m260317_070000_activate_user4 extends Migration
{
    public function safeUp()
    {
        $this->update('{{%user}}', ['status' => 10], ['username' => 'user4']);
    }

    public function safeDown()
    {
        $this->update('{{%user}}', ['status' => 9], ['username' => 'user4']);
    }
}


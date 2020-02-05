<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%events}}`.
 */
class m200205_185033_create_events_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%events}}', [
            'id' => $this->primaryKey(),
            'title' => $this->char(100)->null(),
            'description' => $this->text()->null()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%events}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%invoices}}`.
 */
class m200204_204902_create_invoices_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%invoices}}', [
            'id' => $this->primaryKey(),
            'invoice_number' => $this->integer(10)->notNull(),
            'invoice_total' =>$this->double()->null(),
            'invoice_date' => $this->date()->null()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%invoices}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%invoice_items}}`.
 */
class m200204_205441_create_invoice_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%invoice_items}}', [
            'id' => $this->primaryKey(),
            'id_invoice' => $this->integer()->notNull(),
            'item_code' => $this->integer()->notNull(),
            'quantity' => $this->double()->notNull()
        ]);

        $this->addForeignKey(
            'fk-post_tag-id_invoice',
            'invoice_items',
            'id_invoice',
            'invoices',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%invoice_items}}');
    }
}

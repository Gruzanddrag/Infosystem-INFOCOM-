<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%umks}}`.
 */
class m200316_074949_create_umks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%umks}}', [
            'umkId' => $this->primaryKey(),
            'lawJustification' => $this->text()->notNull(),
            'purpose' => $this->text()->notNull(),
            'totalHours' => $this->integer(),
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%umks}}');
    }
}

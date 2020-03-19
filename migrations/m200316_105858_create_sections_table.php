<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sections}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%umks}}`
 */
class m200316_105858_create_sections_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%sections}}', [
            'sectionId' => $this->primaryKey(),
            'sectionName' => $this->string(),
            'sectionDescription' => $this->text(),
            'umkId' => $this->integer()->notNull(),
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        // creates index for column `umkId`
        $this->createIndex(
            '{{%idx-sections-umkId}}',
            '{{%sections}}',
            'umkId'
        );

        // add foreign key for table `{{%umks}}`
        $this->addForeignKey(
            '{{%fk-sections-umkId}}',
            '{{%sections}}',
            'umkId',
            '{{%umks}}',
            'umkId',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%umk_statuses}}');
        
        // drops foreign key for table `{{%umks}}`
        $this->dropForeignKey(
            '{{%fk-sections-umkId}}',
            '{{%sections}}'
        );

        // drops index for column `umkId`
        $this->dropIndex(
            '{{%idx-sections-umkId}}',
            '{{%sections}}'
        );

        $this->dropTable('{{%sections}}');
    }
}

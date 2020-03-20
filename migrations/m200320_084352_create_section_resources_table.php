<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%section_resources}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%sections}}`
 * - `{{%rousources}}`
 */
class m200320_084352_create_section_resources_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%section_resources}}', [
            'id' => $this->primaryKey(),
            'sectionId' => $this->integer()->notNull(),
            'resourceId' => $this->integer()->notNull(),
            'count' => $this->integer()->defaultValue(0),
        ]);

        // creates index for column `sectionId`
        $this->createIndex(
            '{{%idx-section_resources-sectionId}}',
            '{{%section_resources}}',
            'sectionId'
        );

        // add foreign key for table `{{%sections}}`
        $this->addForeignKey(
            '{{%fk-section_resources-sectionId}}',
            '{{%section_resources}}',
            'sectionId',
            '{{%sections}}',
            'sectionId',
            'CASCADE'
        );

        // creates index for column `resourceId`
        $this->createIndex(
            '{{%idx-section_resources-resourceId}}',
            '{{%section_resources}}',
            'resourceId'
        );

        // add foreign key for table `{{%rousources}}`
        $this->addForeignKey(
            '{{%fk-section_resources-resourceId}}',
            '{{%section_resources}}',
            'resourceId',
            'resources',
            'resourceId',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%sections}}`
        $this->dropForeignKey(
            '{{%fk-section_resources-sectionId}}',
            '{{%section_resources}}'
        );

        // drops index for column `sectionId`
        $this->dropIndex(
            '{{%idx-section_resources-sectionId}}',
            '{{%section_resources}}'
        );

        // drops foreign key for table `{{%rousources}}`
        $this->dropForeignKey(
            '{{%fk-section_resources-resourceId}}',
            '{{%section_resources}}'
        );

        // drops index for column `resourceId`
        $this->dropIndex(
            '{{%idx-section_resources-resourceId}}',
            '{{%section_resources}}'
        );

        $this->dropTable('{{%section_resources}}');
    }
}

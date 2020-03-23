<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%umk_resources}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%umks}}`
 * - `{{%resources}}`
 */
class m200322_231146_create_umk_resources_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%umk_resources}}', [
            'umkResourceId' => $this->primaryKey(),
            'umkId' => $this->integer()->notNull(),
            'resourceId' => $this->integer()->notNull(),
            'count' => $this->integer()->defaultValue(0),
        ]);

        // creates index for column `umkId`
        $this->createIndex(
            '{{%idx-umk_resources-umkId}}',
            '{{%umk_resources}}',
            'umkId'
        );

        // add foreign key for table `{{%umks}}`
        $this->addForeignKey(
            '{{%fk-umk_resources-umkId}}',
            '{{%umk_resources}}',
            'umkId',
            '{{%umks}}',
            'umkId',
            'CASCADE'
        );

        // creates index for column `resourceId`
        $this->createIndex(
            '{{%idx-umk_resources-resourceId}}',
            '{{%umk_resources}}',
            'resourceId'
        );

        // add foreign key for table `{{%resources}}`
        $this->addForeignKey(
            '{{%fk-umk_resources-resourceId}}',
            '{{%umk_resources}}',
            'resourceId',
            '{{%resources}}',
            'resourceId',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%umks}}`
        $this->dropForeignKey(
            '{{%fk-umk_resources-umkId}}',
            '{{%umk_resources}}'
        );

        // drops index for column `umkId`
        $this->dropIndex(
            '{{%idx-umk_resources-umkId}}',
            '{{%umk_resources}}'
        );

        // drops foreign key for table `{{%resources}}`
        $this->dropForeignKey(
            '{{%fk-umk_resources-resourceId}}',
            '{{%umk_resources}}'
        );

        // drops index for column `resourceId`
        $this->dropIndex(
            '{{%idx-umk_resources-resourceId}}',
            '{{%umk_resources}}'
        );

        $this->dropTable('{{%umk_resources}}');
    }
}

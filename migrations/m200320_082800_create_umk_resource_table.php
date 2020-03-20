<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%umk_resource}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%umks}}`
 * - `{{%resources}}`
 */
class m200320_082800_create_umk_resource_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%umk_resource}}', [
            'id' => $this->primaryKey(),
            'umkId' => $this->integer()->notNull(),
            'resourceId' => $this->integer()->notNull(),
        ]);

        // creates index for column `umkId`
        $this->createIndex(
            '{{%idx-umk_resource-umkId}}',
            '{{%umk_resource}}',
            'umkId'
        );

        // add foreign key for table `{{%umks}}`
        $this->addForeignKey(
            '{{%fk-umk_resource-umkId}}',
            '{{%umk_resource}}',
            'umkId',
            '{{%umks}}',
            'umkId',
            'CASCADE'
        );

        // creates index for column `resourceId`
        $this->createIndex(
            '{{%idx-umk_resource-resourceId}}',
            '{{%umk_resource}}',
            'resourceId'
        );

        // add foreign key for table `{{%resources}}`
        $this->addForeignKey(
            '{{%fk-umk_resource-resourceId}}',
            '{{%umk_resource}}',
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
            '{{%fk-umk_resource-umkId}}',
            '{{%umk_resource}}'
        );

        // drops index for column `umkId`
        $this->dropIndex(
            '{{%idx-umk_resource-umkId}}',
            '{{%umk_resource}}'
        );

        // drops foreign key for table `{{%resources}}`
        $this->dropForeignKey(
            '{{%fk-umk_resource-resourceId}}',
            '{{%umk_resource}}'
        );

        // drops index for column `resourceId`
        $this->dropIndex(
            '{{%idx-umk_resource-resourceId}}',
            '{{%umk_resource}}'
        );

        $this->dropTable('{{%umk_resource}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%resources}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%resource_types}}`
 */
class m200317_094125_create_resources_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%resources}}', [
            'resourceId' => $this->primaryKey(),
            'resourceName' => $this->string()->notNull(),
            'resourceCountAvalible' => $this->integer(),
            'resourceTypeId' => $this->integer()->notNull(),
        ]);

        // creates index for column `resourceTypeId`
        $this->createIndex(
            '{{%idx-resources-resourceTypeId}}',
            '{{%resources}}',
            'resourceTypeId'
        );

        // add foreign key for table `{{%resource_types}}`
        $this->addForeignKey(
            '{{%fk-resources-resourceTypeId}}',
            '{{%resources}}',
            'resourceTypeId',
            '{{%resource_types}}',
            'resourceTypeId',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%resource_types}}`
        $this->dropForeignKey(
            '{{%fk-resources-resourceTypeId}}',
            '{{%resources}}'
        );

        // drops index for column `resourceTypeId`
        $this->dropIndex(
            '{{%idx-resources-resourceTypeId}}',
            '{{%resources}}'
        );

        $this->dropTable('{{%resources}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%resource_movement}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%resource_movement_types}}`
 * - `{{%resources}}`
 */
class m200317_094443_create_resource_movement_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%resource_movement}}', [
            'resourceMovementId' => $this->primaryKey(),
            'resourceMovementDate' => $this->datetime()->notNull(),
            'resourceMovementTypeId' => $this->integer(),
            'resourceId' => $this->integer()->notNull(),
        ]);

        // creates index for column `resourceMovementTypeId`
        $this->createIndex(
            '{{%idx-resource_movement-resourceMovementTypeId}}',
            '{{%resource_movement}}',
            'resourceMovementTypeId'
        );

        // add foreign key for table `{{%resource_movement_types}}`
        $this->addForeignKey(
            '{{%fk-resource_movement-resourceMovementTypeId}}',
            '{{%resource_movement}}',
            'resourceMovementTypeId',
            '{{%resource_movement_types}}',
            'resourceMovementTypeId',
            'CASCADE'
        );

        // creates index for column `resourceId`
        $this->createIndex(
            '{{%idx-resource_movement-resourceId}}',
            '{{%resource_movement}}',
            'resourceId'
        );

        // add foreign key for table `{{%resources}}`
        $this->addForeignKey(
            '{{%fk-resource_movement-resourceId}}',
            '{{%resource_movement}}',
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
        // drops foreign key for table `{{%resource_movement_types}}`
        $this->dropForeignKey(
            '{{%fk-resource_movement-resourceMovementTypeId}}',
            '{{%resource_movement}}'
        );

        // drops index for column `resourceMovementTypeId`
        $this->dropIndex(
            '{{%idx-resource_movement-resourceMovementTypeId}}',
            '{{%resource_movement}}'
        );

        // drops foreign key for table `{{%resources}}`
        $this->dropForeignKey(
            '{{%fk-resource_movement-resourceId}}',
            '{{%resource_movement}}'
        );

        // drops index for column `resourceId`
        $this->dropIndex(
            '{{%idx-resource_movement-resourceId}}',
            '{{%resource_movement}}'
        );

        $this->dropTable('{{%resource_movement}}');
    }
}

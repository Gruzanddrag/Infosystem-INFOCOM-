<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%movement_types}}`.
 */
class m200317_092851_create_movement_types_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%resource_movement_types}}', [
            'resourceMovementTypeId' => $this->primaryKey(),
            'resourceMovementTypeAlias' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%resource_movement_types}}');
    }
}

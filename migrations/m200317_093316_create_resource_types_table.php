<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%resource_types}}`.
 */
class m200317_093316_create_resource_types_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%resource_types}}', [
            'resourceTypeId' => $this->primaryKey(),
            'resourceTypeAlias' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%resource_types}}');
    }
}

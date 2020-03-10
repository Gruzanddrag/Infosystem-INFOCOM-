<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%userRoles}}`.
 */
class m200310_074240_create_userRoles_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%userRoles}}', [
            'roleId' => $this->primaryKey(),
            'roleAlias' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%userRoles}}');
    }
}

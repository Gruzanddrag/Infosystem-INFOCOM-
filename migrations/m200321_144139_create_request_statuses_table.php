<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%request_statuses}}`.
 */
class m200321_144139_create_request_statuses_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%request_statuses}}', [
            'requestStatusId' => $this->primaryKey(),
            'requestStatusName' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%request_statuses}}');
    }
}

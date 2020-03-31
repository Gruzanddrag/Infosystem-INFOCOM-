<?php

use yii\db\Migration;

/**
 * Class m200330_132429_insert_to_request_statuses
 */
class m200330_132429_insert_to_request_statuses extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('request_statuses', [
            'requestStatusName' => 'Отклонен'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('request_statuses', ['requestStatusId' => 5]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200330_132429_insert_to_request_statuses cannot be reverted.\n";

        return false;
    }
    */
}

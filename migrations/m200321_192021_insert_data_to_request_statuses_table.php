<?php

use yii\db\Migration;

/**
 * Class m200321_192021_insert_data_to_request_statuses_table
 */
class m200321_192021_insert_data_to_request_statuses_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->insert('request_statuses', [
            'requestStatusName' => 'Не подтвержден'
        ]);

        $this->insert('request_statuses', [
            'requestStatusName' => 'В исполнении'
        ]);


        $this->insert('request_statuses', [
            'requestStatusName' => 'Исполнен'
        ]);

        $this->insert('request_statuses', [
            'requestStatusName' => 'Не исполнен'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('request_statuses', ['requestStatusId' => 4]);
        $this->delete('request_statuses', ['requestStatusId' => 3]);
        $this->delete('request_statuses', ['requestStatusId' => 2]);
        $this->delete('request_statuses', ['requestStatusId' => 1]);

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200321_192021_insert_data_to_request_statuses_table cannot be reverted.\n";

        return false;
    }
    */
}

<?php

use yii\db\Migration;

/**
 * Class m200319_112439_add_data_to_umk_statuses_table
 */
class m200319_112439_add_data_to_umk_statuses_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->insert('umk_statuses', [
            'umkStatusText' => 'Утверждено'
        ]);

        $this->insert('umk_statuses', [
            'umkStatusText' => 'На рассмотрении'
        ]);

        $this->insert('umk_statuses', [
            'umkStatusText' => 'Отклонено'
        ]);

        $this->insert('umk_statuses', [
            'umkStatusText' => 'Не хватает литературы'
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('umk_statuses', ['umkStatusId' => 4]);
        $this->delete('umk_statuses', ['umkStatusId' => 3]);
        $this->delete('umk_statuses', ['umkStatusId' => 2]);
        $this->delete('umk_statuses', ['umkStatusId' => 1]);
        
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200319_112439_add_data_to_umk_statuses_table cannot be reverted.\n";

        return false;
    }
    */
}

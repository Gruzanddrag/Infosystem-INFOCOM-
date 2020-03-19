<?php

use yii\db\Migration;

/**
 * Class m200319_114311_insert_data_to_resource_types_table
 */
class m200319_114311_insert_data_to_resource_types_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->insert('resource_types', [
            'resourceTypeAlias' => 'Книга'
        ]);
        $this->insert('resource_types', [
            'resourceTypeAlias' => 'Методические рекомендации'
        ]);
        $this->insert('resource_types', [
            'resourceTypeAlias' => 'Интернет ресурс'
        ]);


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        
        $this->delete('resource_types', ['resourceTypeId' => 3]);
        $this->delete('resource_types', ['resourceTypeId' => 2]);
        $this->delete('resource_types', ['resourceTypeId' => 1]);

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200319_114311_insert_data_to_resource_types_table cannot be reverted.\n";

        return false;
    }
    */
}

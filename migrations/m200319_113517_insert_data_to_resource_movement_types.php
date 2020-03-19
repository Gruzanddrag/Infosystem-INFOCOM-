<?php

use yii\db\Migration;

/**
 * Class m200319_113517_insert_data_to_resource_movement_types
 */
class m200319_113517_insert_data_to_resource_movement_types extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        
        $this->insert('resource_movement_types', [
            'resourceMovementTypeAlias' => 'Списание'
        ]);

        $this->insert('resource_movement_types', [
            'resourceMovementTypeAlias' => 'Приход'
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('resource_movement_types', ['resourceMovementTypeId' => 2]);
        $this->delete('resource_movement_types', ['resourceMovementTypeId' => 1]);

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200319_113517_insert_data_to_resource_movement_types cannot be reverted.\n";

        return false;
    }
    */
}

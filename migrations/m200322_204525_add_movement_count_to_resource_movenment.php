<?php

use yii\db\Migration;

/**
 * Class m200322_204525_add_movement_count_to_resource_movenment
 */
class m200322_204525_add_movement_count_to_resource_movenment extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('resource_movement','resourceMovementCountState',$this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200322_204525_add_movement_count_to_resource_movenment cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200322_204525_add_movement_count_to_resource_movenment cannot be reverted.\n";

        return false;
    }
    */
}

<?php

use yii\db\Migration;

/**
 * Class m200322_203617_add_movement_reason_to_resource_movenment
 */
class m200322_203617_add_movement_reason_to_resource_movenment extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('resource_movement','resourceMovementReason',$this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200322_203617_add_movement_reason_to_resource_movenment cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200322_203617_add_movement_reason_to_resource_movenment cannot be reverted.\n";

        return false;
    }
    */
}

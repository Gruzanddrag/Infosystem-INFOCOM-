<?php

use yii\db\Migration;

/**
 * Class m200330_121109_add_disctiption_to_movement
 */
class m200330_121109_add_disctiption_to_movement extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('resource_movement','resourceMovementCountDescription',$this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('resource_movement','resourceMovementCountDescription');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200330_121109_add_disctiption_to_movement cannot be reverted.\n";

        return false;
    }
    */
}

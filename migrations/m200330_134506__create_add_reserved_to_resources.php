<?php

use yii\db\Migration;

/**
 * Class m200330_134506__create_add_reserved_to_resources
 */
class m200330_134506__create_add_reserved_to_resources extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('umk_resources','isBooked',$this->boolean());
        $this->addColumn('section_resources','isBooked',$this->boolean());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('umk_resources','isBooked');
        $this->dropColumn('umk_resources','isBooked');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200330_134506__create_add_reserved_to_resources cannot be reverted.\n";

        return false;
    }
    */
}

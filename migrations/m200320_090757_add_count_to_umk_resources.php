<?php

use yii\db\Migration;

/**
 * Class m200320_090757_add_count_to_umk_resources
 */
class m200320_090757_add_count_to_umk_resources extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('umk_resources', 'count', 'integer')->defaulValue(0)
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200320_090757_add_count_to_umk_resources cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200320_090757_add_count_to_umk_resources cannot be reverted.\n";

        return false;
    }
    */
}

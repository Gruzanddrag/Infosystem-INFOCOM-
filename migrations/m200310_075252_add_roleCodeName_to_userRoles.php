<?php

use yii\db\Migration;

/**
 * Class m200310_075252_add_roleCodeName_to_userRoles
 */
class m200310_075252_add_roleCodeName_to_userRoles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('userRoles','roleCodeName','string');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200310_075252_add_roleCodeName_to_userRoles cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200310_075252_add_roleCodeName_to_userRoles cannot be reverted.\n";

        return false;
    }
    */
}

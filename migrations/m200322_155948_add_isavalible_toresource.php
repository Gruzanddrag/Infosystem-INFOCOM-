<?php

use yii\db\Migration;

/**
 * Class m200322_155948_add_isavalible_toresource
 */
class m200322_155948_add_isavalible_toresource extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('resources', 'isAvalible', $this->boolean());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200322_155948_add_isavalible_toresource cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200322_155948_add_isavalible_toresource cannot be reverted.\n";

        return false;
    }
    */
}

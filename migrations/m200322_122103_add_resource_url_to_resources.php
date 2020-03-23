<?php

use yii\db\Migration;

/**
 * Class m200322_122103_add_resource_url_to_resources
 */
class m200322_122103_add_resource_url_to_resources extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('resources', 'resourceUrl', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200322_122103_add_resource_url_to_resources cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200322_122103_add_resource_url_to_resources cannot be reverted.\n";

        return false;
    }
    */
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%discipline}}`.
 */
class m200317_091636_create_discipline_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%discipline}}', [
            'disciplineId' => $this->primaryKey(),
            'disciplineName' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%discipline}}');
    }
}

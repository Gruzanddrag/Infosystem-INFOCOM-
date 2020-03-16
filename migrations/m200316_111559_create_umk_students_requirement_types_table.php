<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%umk_students_requirement_types}}`.
 */
class m200316_111559_create_umk_students_requirement_types_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%umk_students_requirement_types}}', [
            'studentRequirementTypeId' => $this->primaryKey(),
            'studentRequirementTypeAlias' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%umk_students_requirement_types}}');
    }
}

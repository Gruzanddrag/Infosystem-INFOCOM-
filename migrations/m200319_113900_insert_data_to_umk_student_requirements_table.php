<?php

use yii\db\Migration;

/**
 * Class m200319_113900_insert_data_to_umk_student_requirements_table
 */
class m200319_113900_insert_data_to_umk_student_requirements_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        
        $this->insert('umk_students_requirement_types', [
            'studentRequirementTypeAlias' => 'Должен знать'
        ]);
        $this->insert('umk_students_requirement_types', [
            'studentRequirementTypeAlias' => 'Должен уметь'
        ]);
        $this->insert('umk_students_requirement_types', [
            'studentRequirementTypeAlias' => 'Должен быть ознакомлен с'
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('umk_students_requirement_types', ['studentRequirementTypeId' => 3]);
        $this->delete('umk_students_requirement_types', ['studentRequirementTypeId' => 2]);
        $this->delete('umk_students_requirement_types', ['studentRequirementTypeId' => 1]);

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200319_113900_insert_data_to_umk_student_requirements_table cannot be reverted.\n";

        return false;
    }
    */
}

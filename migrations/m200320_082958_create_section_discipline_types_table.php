<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%section_discipline_types}}`.
 */
class m200320_082958_create_section_discipline_types_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%section_discipline_types}}', [
            'sectionDisciplineTypeId' => $this->primaryKey(),
            'sectionDisciplineTypeName' => $this->string()->notNull(),
        ]);

        $this->insert('section_discipline_types',[
            'sectionDisciplineTypeName' => 'Практическое занятие'
        ]);

        $this->insert('section_discipline_types',[
            'sectionDisciplineTypeName' => 'Лекционное занятие'
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        
        $this->delete('section_discipline_types', ['sectionDisciplineTypeId' => 2]);
        $this->delete('section_discipline_types', ['sectionDisciplineTypeId' => 1]);

        $this->dropTable('{{%section_discipline_types}}');
    }
}

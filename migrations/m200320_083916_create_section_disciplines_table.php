<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%section_disciplines}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%sections}}`
 * - `{{%disciplines}}`
 * - `{{%section_discipline_types}}`
 */
class m200320_083916_create_section_disciplines_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%section_disciplines}}', [
            'sectionId' => $this->integer()->notNull(),
            'disciplineId' => $this->integer()->notNull(),
            'sectionDisciplineId' => $this->primaryKey(),
            'sectionDisciplineHours' => $this->integer()->defaultValue(0),
            'sectionDisciplineTypeId' => $this->integer()->notNull(),
        ]);

        // creates index for column `sectionId`
        $this->createIndex(
            '{{%idx-section_disciplines-sectionId}}',
            '{{%section_disciplines}}',
            'sectionId'
        );

        // add foreign key for table `{{%sections}}`
        $this->addForeignKey(
            '{{%fk-section_disciplines-sectionId}}',
            '{{%section_disciplines}}',
            'sectionId',
            '{{%sections}}',
            'sectionId',
            'CASCADE'
        );

        // creates index for column `disciplineId`
        $this->createIndex(
            '{{%idx-section_disciplines-disciplineId}}',
            '{{%section_disciplines}}',
            'disciplineId'
        );

        // add foreign key for table `{{%disciplines}}`
        $this->addForeignKey(
            '{{%fk-section_disciplines-disciplineId}}',
            '{{%section_disciplines}}',
            'disciplineId',
            'discipline',
            'disciplineId',
            'CASCADE'
        );

        // creates index for column `sectionDisciplineTypeId`
        $this->createIndex(
            '{{%idx-section_disciplines-sectionDisciplineTypeId}}',
            '{{%section_disciplines}}',
            'sectionDisciplineTypeId'
        );

        // add foreign key for table `{{%section_discipline_types}}`
        $this->addForeignKey(
            '{{%fk-section_disciplines-sectionDisciplineTypeId}}',
            '{{%section_disciplines}}',
            'sectionDisciplineTypeId',
            '{{%section_discipline_types}}',
            'sectionDisciplineTypeId',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%sections}}`
        $this->dropForeignKey(
            '{{%fk-section_disciplines-sectionId}}',
            '{{%section_disciplines}}'
        );

        // drops index for column `sectionId`
        $this->dropIndex(
            '{{%idx-section_disciplines-sectionId}}',
            '{{%section_disciplines}}'
        );

        // drops foreign key for table `{{%disciplines}}`
        $this->dropForeignKey(
            '{{%fk-section_disciplines-disciplineId}}',
            '{{%section_disciplines}}'
        );

        // drops index for column `disciplineId`
        $this->dropIndex(
            '{{%idx-section_disciplines-disciplineId}}',
            '{{%section_disciplines}}'
        );

        // drops foreign key for table `{{%section_discipline_types}}`
        $this->dropForeignKey(
            '{{%fk-section_disciplines-sectionDisciplineTypeId}}',
            '{{%section_disciplines}}'
        );

        // drops index for column `sectionDisciplineTypeId`
        $this->dropIndex(
            '{{%idx-section_disciplines-sectionDisciplineTypeId}}',
            '{{%section_disciplines}}'
        );

        $this->dropTable('{{%section_disciplines}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%umk_student_requirements}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%umks}}`
 * - `{{%umk_student_requirement_types}}`
 */
class m200316_112105_create_umk_student_requirements_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%umk_student_requirements}}', [
            'studentRequirementId' => $this->primaryKey(),
            'studentRequirementText' => $this->text(),
            'umkId' => $this->integer()->notNull(),
            'studentRequirementTypeId' => $this->integer()->notNull(),
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        // creates index for column `umkId`
        $this->createIndex(
            '{{%idx-umk_student_requirements-umkId}}',
            '{{%umk_student_requirements}}',
            'umkId'
        );

        // add foreign key for table `{{%umks}}`
        $this->addForeignKey(
            '{{%fk-umk_student_requirements-umkId}}',
            '{{%umk_student_requirements}}',
            'umkId',
            '{{%umks}}',
            'umkId',
            'CASCADE'
        );

        // creates index for column `studentRequirementTypeId`
        $this->createIndex(
            '{{%idx-umk_student_requirements-studentRequirementTypeId}}',
            '{{%umk_student_requirements}}',
            'studentRequirementTypeId'
        );

        // add foreign key for table `{{%umk_student_requirement_types}}`
        $this->addForeignKey(
            '{{%fk-umk_student_requirements-studentRequirementTypeId}}',
            '{{%umk_student_requirements}}',
            'studentRequirementTypeId',
            '{{%umk_student_requirement_types}}',
            'studentRequirementTypeId',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%umks}}`
        $this->dropForeignKey(
            '{{%fk-umk_student_requirements-umkId}}',
            '{{%umk_student_requirements}}'
        );

        // drops index for column `umkId`
        $this->dropIndex(
            '{{%idx-umk_student_requirements-umkId}}',
            '{{%umk_student_requirements}}'
        );

        // drops foreign key for table `{{%umk_student_requirement_types}}`
        $this->dropForeignKey(
            '{{%fk-umk_student_requirements-studentRequirementTypeId}}',
            '{{%umk_student_requirements}}'
        );

        // drops index for column `studentRequirementTypeId`
        $this->dropIndex(
            '{{%idx-umk_student_requirements-studentRequirementTypeId}}',
            '{{%umk_student_requirements}}'
        );

        $this->dropTable('{{%umk_student_requirements}}');
    }
}

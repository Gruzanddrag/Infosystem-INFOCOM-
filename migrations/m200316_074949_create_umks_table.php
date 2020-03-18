<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%umks}}`.
 */
class m200316_074949_create_umks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('{{%umk_statuses}}', [
            'umkStatusId' => $this->primaryKey(),
            'umkStatusText' => $this->string(),
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        $this->createTable('{{%umks}}', [
            'umkId' => $this->primaryKey(),
            'umkName' => $this->string()->notNull(),
            'umkTotalHours' => $this->integer()->notNull()->defaultValue(0),
            'umkPurpose' => $this->text(),
            'umkLawJustification' => $this->text(),
            'umkStatusId' => $this->integer(),
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        // creates index for column `umkStatusId`
        $this->createIndex(
            '{{%idx-umks-umkStatusId}}',
            '{{%umks}}',
            'umkStatusId'
        );

        // add foreign key for table `{{%umk_statuses}}`
        $this->addForeignKey(
            '{{%fk-umks-umkStatusId}}',
            '{{%umks}}',
            'umkStatusId',
            '{{%umk_statuses}}',
            'umkStatusId',
            'SET NULL'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%umk_statuses}}`
        $this->dropForeignKey(
            '{{%fk-umks-umkStatusId}}',
            '{{%umks}}'
        );

        // drops index for column `umkStatusId`
        $this->dropIndex(
            '{{%idx-umks-umkStatusId}}',
            '{{%umks}}'
        );

        $this->dropTable('{{%umks}}');
    }
}

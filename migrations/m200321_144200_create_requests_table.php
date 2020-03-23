<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%requests}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%resources}}`
 * - `{{%request_statuses}}`
 * - `{{%users}}`
 */
class m200321_144200_create_requests_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%requests}}', [
            'requestId' => $this->primaryKey(),
            'resourceId' => $this->integer()->notNull(),
            'count' => $this->integer()->notNull(),
            'requestStatusId' => $this->integer()->notNull(),
            'requestType' => $this->string()->notNull(),
            'userId' => $this->integer()->notNull(),
            'date' => $this->datetime()->notNull(),
        ]);

        // creates index for column `resourceId`
        $this->createIndex(
            '{{%idx-requests-resourceId}}',
            '{{%requests}}',
            'resourceId'
        );

        // add foreign key for table `{{%resources}}`
        $this->addForeignKey(
            '{{%fk-requests-resourceId}}',
            '{{%requests}}',
            'resourceId',
            '{{%resources}}',
            'resourceId',
            'CASCADE'
        );

        // creates index for column `requestStatusId`
        $this->createIndex(
            '{{%idx-requests-requestStatusId}}',
            '{{%requests}}',
            'requestStatusId'
        );

        // add foreign key for table `{{%request_statuses}}`
        $this->addForeignKey(
            '{{%fk-requests-requestStatusId}}',
            '{{%requests}}',
            'requestStatusId',
            '{{%request_statuses}}',
            'requestStatusId',
            'CASCADE'
        );

        // creates index for column `userId`
        $this->createIndex(
            '{{%idx-requests-userId}}',
            '{{%requests}}',
            'userId'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-requests-userId}}',
            '{{%requests}}',
            'userId',
            '{{%users}}',
            'userId',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%resources}}`
        $this->dropForeignKey(
            '{{%fk-requests-resourceId}}',
            '{{%requests}}'
        );

        // drops index for column `resourceId`
        $this->dropIndex(
            '{{%idx-requests-resourceId}}',
            '{{%requests}}'
        );

        // drops foreign key for table `{{%request_statuses}}`
        $this->dropForeignKey(
            '{{%fk-requests-requestStatusId}}',
            '{{%requests}}'
        );

        // drops index for column `requestStatusId`
        $this->dropIndex(
            '{{%idx-requests-requestStatusId}}',
            '{{%requests}}'
        );

        // drops foreign key for table `{{%users}}`
        $this->dropForeignKey(
            '{{%fk-requests-userId}}',
            '{{%requests}}'
        );

        // drops index for column `userId`
        $this->dropIndex(
            '{{%idx-requests-userId}}',
            '{{%requests}}'
        );

        $this->dropTable('{{%requests}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%roleId}}`
 */
class m200310_074734_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'userId' => $this->primaryKey(),
            'phone' => $this->string(),
            'name' => $this->string(),
            'email' => $this->string()->notNull()->unique(),
            'password' => $this->string(),
            'surname' => $this->string(),
            'patronymic' => $this->string(),
            'roleId' => $this->integer(),
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');
        // creates index for column `roleId`
        $this->createIndex(
            '{{%idx-users-roleId}}',
            '{{%users}}',
            'roleId'
        );

        // add foreign key for table `{{%roleId}}`
        $this->addForeignKey(
            '{{%fk-users-roleId}}',
            '{{%users}}',
            'roleId',
            '{{%userRoles}}',
            'roleId',
            'SET NULL'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%roleId}}`
        $this->dropForeignKey(
            '{{%fk-users-roleId}}',
            '{{%users}}'
        );

        // drops index for column `roleId`
        $this->dropIndex(
            '{{%idx-users-roleId}}',
            '{{%users}}'
        );

        $this->dropTable('{{%users}}');
    }
}

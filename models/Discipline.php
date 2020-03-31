<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "discipline".
 *
 * @property int $disciplineId
 * @property string|null $disciplineName
 */
class Discipline extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'discipline';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['disciplineName'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'disciplineId' => 'Discipline ID',
            'disciplineName' => 'Наименование дисциплины',
        ];
    }
}

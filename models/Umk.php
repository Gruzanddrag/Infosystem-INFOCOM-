<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "umks".
 *
 * @property int $umkId
 * @property string $lawJustification
 * @property string $purpose
 * @property int|null $totalHours
 */
class Umk extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'umks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lawJustification', 'purpose'], 'required'],
            [['lawJustification', 'purpose'], 'string'],
            [['totalHours'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'umkId' => 'Umk ID',
            'lawJustification' => 'Law Justification',
            'purpose' => 'Purpose',
            'totalHours' => 'Total Hours',
        ];
    }
}

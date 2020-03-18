<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "umks".
 *
 * @property int $umkId
 * @property string $umkName
 * @property int $umkTotalHours
 * @property string|null $umkPurpose
 * @property string|null $umkLawJustification
 * @property int $umkStatusId
 *
 * @property Sections[] $sections
 * @property UmkStudentRequirements[] $umkStudentRequirements
 * @property UmkStatuses $umkStatus
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
            [['umkName'], 'required'],
            [['umkTotalHours', 'umkStatusId'], 'integer'],
            [['umkPurpose', 'umkLawJustification'], 'string'],
            [['umkName'], 'string', 'max' => 255],
            [['umkStatusId'], 'exist', 'skipOnError' => true, 'targetClass' => UmkStatus::className(), 'targetAttribute' => ['umkStatusId' => 'umkStatusId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'umkId' => 'Umk ID',
            'umkName' => 'Umk Name',
            'umkTotalHours' => 'Umk Total Hours',
            'umkPurpose' => 'Umk Purpose',
            'umkLawJustification' => 'Umk Law Justification',
            'umkStatusId' => 'Umk Status ID',
        ];
    }

    /**
     * Gets query for [[Sections]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSections()
    {
        return $this->hasMany(Sections::className(), ['umkId' => 'umkId']);
    }

    /**
     * Gets query for [[UmkStudentRequirements]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUmkStudentRequirements()
    {
        return $this->hasMany(UmkStudentRequirements::className(), ['umkId' => 'umkId']);
    }

    /**
     * Gets query for [[UmkStatus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUmkStatus()
    {
        return $this->hasOne(UmkStatus::className(), ['umkStatusId' => 'umkStatusId']);
    }
}

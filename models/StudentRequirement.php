<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "umk_student_requirements".
 *
 * @property int $studentRequirementId
 * @property string|null $studentRequirementText
 * @property int $umkId
 * @property int|null $studentRequirementTypeId
 *
 * @property UmkStudentsRequirementTypes $studentRequirementType
 * @property Umks $umk
 */
class StudentRequirement extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'umk_student_requirements';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['studentRequirementText'], 'string'],
            [['umkId'], 'required'],
            [['umkId', 'studentRequirementTypeId'], 'integer'],
            [['studentRequirementTypeId'], 'exist', 'skipOnError' => true, 'targetClass' => UmkStudentsRequirementTypes::className(), 'targetAttribute' => ['studentRequirementTypeId' => 'studentRequirementTypeId']],
            [['umkId'], 'exist', 'skipOnError' => true, 'targetClass' => Umks::className(), 'targetAttribute' => ['umkId' => 'umkId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'studentRequirementId' => 'Student Requirement ID',
            'studentRequirementText' => 'Student Requirement Text',
            'umkId' => 'Umk ID',
            'studentRequirementTypeId' => 'Student Requirement Type ID',
        ];
    }

    /**
     * Gets query for [[StudentRequirementType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentRequirementType()
    {
        return $this->hasOne(StudentRequirementType::className(), ['studentRequirementTypeId' => 'studentRequirementTypeId']);
    }

    /**
     * Gets query for [[Umk]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUmk()
    {
        return $this->hasOne(Umks::className(), ['umkId' => 'umkId']);
    }
}

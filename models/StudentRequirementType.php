<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "umk_students_requirement_types".
 *
 * @property int $studentRequirementTypeId
 * @property string|null $studentRequirementTypeAlias
 *
 * @property UmkStudentRequirements[] $umkStudentRequirements
 */
class StudentRequirementType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'umk_students_requirement_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['studentRequirementTypeAlias'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'studentRequirementTypeId' => 'Student Requirement Type ID',
            'studentRequirementTypeAlias' => 'Student Requirement Type Alias',
        ];
    }

    /**
     * Gets query for [[UmkStudentRequirements]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUmkStudentRequirements()
    {
        return $this->hasMany(StudentRequirement::className(), ['studentRequirementTypeId' => 'studentRequirementTypeId']);
    }
}

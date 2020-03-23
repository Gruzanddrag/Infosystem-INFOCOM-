<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "section_disciplines".
 *
 * @property int $sectionId
 * @property int $disciplineId
 * @property int $sectionDisciplineId
 * @property int|null $sectionDisciplineHours
 * @property int $sectionDisciplineTypeId
 *
 * @property Discipline $discipline
 * @property SectionDisciplineTypes $sectionDisciplineType
 * @property Sections $section
 */
class SectionDiscipline extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'section_disciplines';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sectionId', 'disciplineId', 'sectionDisciplineTypeId'], 'required'],
            [['sectionId', 'disciplineId', 'sectionDisciplineHours', 'sectionDisciplineTypeId'], 'integer'],
            [['disciplineId'], 'exist', 'skipOnError' => true, 'targetClass' => Discipline::className(), 'targetAttribute' => ['disciplineId' => 'disciplineId']],
            [['sectionDisciplineTypeId'], 'exist', 'skipOnError' => true, 'targetClass' => DisciplineType::className(), 'targetAttribute' => ['sectionDisciplineTypeId' => 'sectionDisciplineTypeId']],
            [['sectionId'], 'exist', 'skipOnError' => true, 'targetClass' => Section::className(), 'targetAttribute' => ['sectionId' => 'sectionId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sectionId' => 'Section ID',
            'disciplineId' => 'Discipline ID',
            'sectionDisciplineId' => 'Section Discipline ID',
            'sectionDisciplineHours' => 'Section Discipline Hours',
            'sectionDisciplineTypeId' => 'Section Discipline Type ID',
        ];
    }

    /**
     * Gets query for [[Discipline]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDiscipline()
    {
        return $this->hasOne(Discipline::className(), ['disciplineId' => 'disciplineId']);
    }

    /**
     * Gets query for [[SectionDisciplineType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSectionDisciplineType()
    {
        return $this->hasOne(nDisciplineTypes::className(), ['sectionDisciplineTypeId' => 'sectionDisciplineTypeId']);
    }

    /**
     * Gets query for [[Section]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSection()
    {
        return $this->hasOne(Section::className(), ['sectionId' => 'sectionId']);
    }
}

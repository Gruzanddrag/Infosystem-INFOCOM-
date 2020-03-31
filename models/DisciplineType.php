<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "section_discipline_types".
 *
 * @property int $sectionDisciplineTypeId
 * @property string $sectionDisciplineTypeName
 *
 * @property SectionDisciplines[] $sectionDisciplines
 */
class DisciplineType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'section_discipline_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sectionDisciplineTypeName'], 'required'],
            [['sectionDisciplineTypeName'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sectionDisciplineTypeId' => 'Section Discipline Type ID',
            'sectionDisciplineTypeName' => 'Тип занятий',
        ];
    }

    /**
     * Gets query for [[SectionDisciplines]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSectionDisciplines()
    {
        return $this->hasMany(SectionDisciplines::className(), ['sectionDisciplineTypeId' => 'sectionDisciplineTypeId']);
    }
}

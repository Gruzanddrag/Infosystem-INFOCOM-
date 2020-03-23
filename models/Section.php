<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sections".
 *
 * @property int $sectionId
 * @property string|null $sectionName
 * @property string|null $sectionDescription
 * @property int $umkId
 *
 * @property SectionDisciplines[] $sectionDisciplines
 * @property SectionResources[] $sectionResources
 * @property Umks $umk
 */
class Section extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sections';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sectionDescription'], 'string'],
            [['umkId'], 'required'],
            [['umkId'], 'integer'],
            [['sectionName'], 'string', 'max' => 255],
            [['umkId'], 'exist', 'skipOnError' => true, 'targetClass' => Umk::className(), 'targetAttribute' => ['umkId' => 'umkId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sectionId' => 'Section ID',
            'sectionName' => 'Section Name',
            'sectionDescription' => 'Section Description',
            'umkId' => 'Umk ID',
        ];
    }

    /**
     * Gets query for [[SectionDisciplines]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSectionDisciplines()
    {
        return $this->hasMany(SectionDiscipline::className(), ['sectionId' => 'sectionId']);
    }

    /**
     * Gets query for [[SectionResources]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSectionResources()
    {
        return $this->hasMany(SectionResource::className(), ['sectionId' => 'sectionId']);
    }

    /**
     * Gets query for [[Umk]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUmk()
    {
        return $this->hasOne(Umk::className(), ['umkId' => 'umkId']);
    }

    
    public function fields(){

        return array_merge(parent::fields(), [
            'sectionDiscipline' => function() {
                return $this->sectionDisciplines;
            },
            'resources' => function() {
                return $this->sectionResources;
            }
        ]);

    }

}

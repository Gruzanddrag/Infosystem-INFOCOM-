<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "umk_statuses".
 *
 * @property int $umkStatusId
 * @property string|null $umkStatusText
 *
 * @property Umks[] $umks
 */
class UmkStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'umk_statuses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['umkStatusText'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'umkStatusId' => 'Umk Status ID',
            'umkStatusText' => 'Umk Status Text',
        ];
    }

    /**
     * Gets query for [[Umks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUmks()
    {
        return $this->hasMany(Umks::className(), ['umkStatusId' => 'umkStatusId']);
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "umk_resources".
 *
 * @property int $umkResourceId
 * @property int $umkId
 * @property int $resourceId
 * @property int|null $count
 *
 * @property Resources $resource
 * @property Umks $umk
 */
class UmkResource extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'umk_resources';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['umkId', 'resourceId'], 'required'],
            [['umkId', 'resourceId', 'count'], 'integer'],
            [['resourceId'], 'exist', 'skipOnError' => true, 'targetClass' => Resource::className(), 'targetAttribute' => ['resourceId' => 'resourceId']],
            [['umkId'], 'exist', 'skipOnError' => true, 'targetClass' => Umk::className(), 'targetAttribute' => ['umkId' => 'umkId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'umkResourceId' => 'Umk Resource ID',
            'umkId' => 'Umk ID',
            'resourceId' => 'Resource ID',
            'count' => 'Количество',
        ];
    }

    /**
     * Gets query for [[Resource]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResource()
    {
        return $this->hasOne(Resource::className(), ['resourceId' => 'resourceId']);
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
    
    public function getResourceState(){
        if($this->isBooked){
            return 'booked';
        } else {
            $res = Resource::findOne($this->resourceId);
            if($this->count <= $res->resourceCountAvalible) {
                return 'stable';
            } else {
                return 'unstable';
            }
        }
    }

    public function fields(){
        return array_merge(parent::fields(), [
            'resourceName' => function() {
                return $this->resource->resourceName;
            },
            'resourceType' => function() {
                return $this->resource->resourceType->resourceTypeAlias;
            },
            'resourceTypeId' => function() {
                return $this->resource->resourceType->resourceTypeId;
            },
            'resourceUrl' => function() {
                return $this->resource->resourceUrl;
            },
            'resourceCountAvalible' => function() {
                return $this->resource->resourceCountAvalible;
            },
        ]);
    }
}

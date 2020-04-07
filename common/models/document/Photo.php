<?php

namespace common\models\document;

use common\modules\attachment\behaviors\UploadBehavior;
use common\modules\attachment\models\Attachment;
use common\traits\EntityTrait;
use Yii;
use common\behaviors\DynamicFormBehavior;

/**
 * This is the model class for table "{{%document_photo}}".
 *
 * @property integer $id
 * @property Attachment[] $photos
 */
class Photo extends \yii\db\ActiveRecord
{
    use EntityTrait;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%document_photo}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'photos'], 'required'],
            [['id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'photos' => '图片',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => UploadBehavior::className(),
                'multiple' => true,
                'attribute' => 'photos',
                'entity' => __CLASS__
            ],
            [
                'class' => DynamicFormBehavior::className(),
                'formAttributes' => [
                    'photos' => [
                        'type' => 'images',
                        'options' => ['widgetOptions' => ['onlyUrl' => false]]
                    ],

                ]
            ]
        ];
    }
}

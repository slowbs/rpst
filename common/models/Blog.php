<?php

namespace common\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "{{%blog}}".
 *
 * @property int $id
 * @property string $title ชื่อเรื่อง
 * @property string $content เนื้อหา
 * @property int $category หมวดหมู่
 * @property string $tag คำค้น
 * @property int $created_at สร้างวันที่
 * @property int $created_by สร้างโดย
 * @property int $updated_at แก้ไขวันที่
 * @property int $updated_by แก้ไขโดย
 */
class Blog extends \yii\db\ActiveRecord
{

    public function behaviors()
    {
        return [
            BlameableBehavior::className(),
            [
                'class' => TimestampBehavior::className(),
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%blog}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['category', 'created_by', 'updated_by'], 'integer'],
            [['title', 'tag', 'created_at', 'updated_at'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'ชื่อเรื่อง',
            'content' => 'เนื้อหา',
            'category' => 'หมวดหมู่',
            'tag' => 'คำค้น',
            'created_at' => 'สร้างวันที่',
            'created_by' => 'สร้างโดย',
            'updated_at' => 'แก้ไขวันที่',
            'updated_by' => 'แก้ไขโดย',
        ];
    }

    /**
     * {@inheritdoc}
     * @return BlogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BlogQuery(get_called_class());
    }
}

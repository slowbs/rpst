<?php

namespace common\models;

use Yii;

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
            [['category', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['title', 'tag'], 'string', 'max' => 255],
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

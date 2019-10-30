<?php

namespace backend\models;

use backend\models\Category;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $image
 * @property int $created_at
 * @property string $category
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [

            [
                'class' => TimestampBehavior::className(),
                'updatedAtAttribute' =>false

            ],

        ];
    }
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at'], 'integer'],
            [['category'], 'required'],
            [['title', 'description', 'image'], 'string', 'max' => 1020],
            [['category'], 'string', 'max' => 255],
            [['category'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'image' => 'Image',
            'created_at' => 'Created At',
            'category' => 'Category',
        ];
    }
    public function getCreatedBy()
    {
        return $this->hasOne(Category::className(), ['id' => 'category']);
    }
}

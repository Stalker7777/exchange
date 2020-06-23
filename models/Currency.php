<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "currency".
 *
 * @property string $id
 * @property string $name
 * @property float $rate
 */
class Currency extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'currency';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name', 'rate'], 'required'],
            [['rate'], 'number'],
            [['id'], 'string', 'max' => 10],
            [['name'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'rate' => 'Rate',
        ];
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ward".
 *
 * @property int $id
 * @property string $name
 * @property int|null $district_id
 */
class Ward extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ward';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['district_id'], 'default', 'value' => null],
            [['name'], 'required'],
            [['district_id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['name'], 'unique'],
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
            'district_id' => 'District ID',
        ];
    }

}

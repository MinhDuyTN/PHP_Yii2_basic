<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property int $id
 * @property string $name
 * @property string|null $note
 * @property string|null $dob
 * @property int|null $province_id
 * @property int|null $district_id
 * @property int|null $ward_id
 * @property string|null $address
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $created_by
 * @property int|null $is_deleted
 */
class Customer extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['note', 'dob', 'province_id', 'district_id', 'ward_id', 'address', 'created_at', 'updated_at', 'created_by'], 'default', 'value' => null],
            [['is_deleted'], 'default', 'value' => 0],
            [['name'], 'required'],
            [['note'], 'string'],
            [['dob', 'created_at', 'updated_at'], 'safe'],
            [['province_id', 'district_id', 'ward_id', 'created_by', 'is_deleted'], 'integer'],
            [['name', 'address'], 'string', 'max' => 50],
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
            'note' => 'Note',
            'dob' => 'Dob',
            'province_id' => 'Province ID',
            'district_id' => 'District ID',
            'ward_id' => 'Ward ID',
            'address' => 'Address',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'is_deleted' => 'Is Deleted',
        ];
    }

}

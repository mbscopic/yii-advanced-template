<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "branches".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $address
 * @property string|null $created_date
 * @property int|null $id_company
 * @property int|null $new_column
 * @property string|null $status
 *
 * @property Companies $company
 * @property Departments[] $departments
 */
class Branches extends \yii\db\ActiveRecord
{
    public $companyName;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'branches';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'address', 'status'], 'string'],
            [['created_date', 'companyName'], 'safe'],
            [['id_company', 'new_column'], 'integer'],
            ['name', 'unique'],
            ['status', 'required', 'when' => function($model) {
                return (!empty($model->address)) ? true : false;
            }, 'whenClient' => "function() {
                    if ($('#branches-address').val() === undefined) {
                        false;
                    } else {
                        true;
                    }
                }"
            ],
            [['id_company'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::className(), 'targetAttribute' => ['id_company' => 'id']],
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
            'address' => 'Address',
            'created_date' => 'Created Date',
            'companyName' => 'Company',
            'id_company' => 'Company',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Companies::className(), ['id' => 'id_company']);
    }

    /**
     * Gets query for [[Departments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasMany(Departments::className(), ['id_branch' => 'id']);
    }
}

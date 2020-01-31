<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "departments".
 *
 * @property int $id
 * @property int|null $id_branch
 * @property int|null $id_company
 * @property string|null $name
 * @property string|null $created_at
 *
 * @property Companies $company
 * @property Branches $branch
 */
class Departments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'departments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_branch', 'id_company'], 'integer'],
            [['name'], 'string'],
            [['created_at'], 'safe'],
            [['id_company'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::className(), 'targetAttribute' => ['id_company' => 'id']],
            [['id_branch'], 'exist', 'skipOnError' => true, 'targetClass' => Branches::className(), 'targetAttribute' => ['id_branch' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_branch' => 'Branch',
            'id_company' => 'Company',
            'name' => 'Name',
            'created_at' => 'Created At',
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
     * Gets query for [[Branch]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branches::className(), ['id' => 'id_branch']);
    }
}

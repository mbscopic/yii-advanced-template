<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "companies".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $address
 * @property string|null $created_date
 * @property string|null $company_email
 *
 * @property Branches[] $branches
 * @property Departments[] $departments
 */
class Companies extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'companies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'logo', 'address', 'company_email'], 'string'],
            [['created_date'], 'safe'],
            [['file'], 'image', 'minWidth' => '1024', 'minHeight' => '1024']
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
            'email' => 'Email',
            'address' => 'Address',
            'created_date' => 'Created Date',
            'company_email' => 'Company Email',
            'file' => 'Logo'
        ];
    }

    /**
     * Gets query for [[Branches]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBranches()
    {
        return $this->hasMany(Branches::className(), ['id_company' => 'id']);
    }

    /**
     * Gets query for [[Departments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasMany(Departments::className(), ['id_company' => 'id']);
    }
}

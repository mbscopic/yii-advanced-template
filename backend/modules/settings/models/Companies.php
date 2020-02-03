<?php

namespace backend\modules\settings\models;

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
 * @property string|null $start_date
 *
 * @property Branches[] $branches
 * @property Departments[] $departments
 */
class Companies extends \yii\db\ActiveRecord
{
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
            [['name', 'email', 'address', 'company_email'], 'string'],
            ['start_date', 'checkDate'],
            [['created_date', 'start_date'], 'safe'],
        ];
    }

    public function checkDate($attribute, $params) {
        $today = date('Y-m-d');
        $selected = date($this->start_date);

        if ($selected > $today) {
            $this->addError($attribute, 'Start date must be smaller');
        }
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
            'start_date' => 'Start Date',
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

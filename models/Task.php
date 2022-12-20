<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $type
 * @property int $person_id
 * @property int|null $company_id
 * @property int $priority
 * @property string $modification_date
 * @property string $creation_date 
 * @property string $finish_date
 * @property int $active
 *
 * @property Companies $company
 * @property People $person
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'type', 'person_id', 'priority'], 'required'],
            [['person_id', 'company_id', 'priority', 'active'], 'integer'],
            [['modification_date', 'creation_date', 'finish_date'], 'safe'],
            [['name', 'description', 'type'], 'string', 'max' => 255],
            [['person_id'], 'exist', 'skipOnError' => true, 'targetClass' => People::class, 'targetAttribute' => ['person_id' => 'id']],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::class, 'targetAttribute' => ['company_id' => 'id']],
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
            'description' => 'Description',
            'type' => 'Type',
            'person_id' => 'Person ID',
            'company_id' => 'Company ID',
            'priority' => 'Priority',
            'modification_date' => 'Modification Date',
            'creation_date' => 'Creation Date',
            'finish_date' => 'Finish Date',
            'active' => 'Active',

        ];
    }

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Companies::class, ['id' => 'company_id']);
    }

    /**
     * Gets query for [[Person]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(People::class, ['id' => 'person_id']);
    }
}

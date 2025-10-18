<?php
// 代码生成时间: 2025-10-18 11:14:42
// data_model_example.php
// This file demonstrates the creation of a data model using the Yii framework.

use yii\db\ActiveRecord;

/**
 * Class User
 * Represents a user data model.
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $created_at
 * @property string $updated_at
 */
class User extends ActiveRecord
{
    // The rules array defines the validation rules for the model's attributes.
    public function rules()
    {
        return [
            // username and email are required
            [['username', 'email'], 'required'],
            // username must be a string with a maximum length of 255 characters
            ['username', 'string', 'max' => 255],
            // email must be a valid email address
            ['email', 'email'],
            // created_at and updated_at will be automatically set by Yii's behavior
            ['created_at', 'safe'],
            ['updated_at', 'safe'],
        ];
    }

    // The behaviors array defines the behaviors for the model.
    public function behaviors()
    {
        return [
            // Yii's TimestampBehavior is used to automatically set created_at and updated_at fields.
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
                ],
            ],
        ];
    }

    // The attributeLabels array defines the labels for the model's attributes for display purposes.
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}

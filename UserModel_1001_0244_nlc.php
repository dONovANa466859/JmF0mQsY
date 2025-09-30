<?php
// 代码生成时间: 2025-10-01 02:44:25
use yii\db\ActiveRecord;
use yii\rbac\Role;
use yii\rbac\Permission;

class UserModel extends ActiveRecord
{
    // Constant definitions for user statuses
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    // AR rules for validation
    public function rules()
    {
        return [
            // Username and email are required
            [['username', 'email'], 'required'],
            // Password is required if user is new
            ['password', 'required', 'on' => 'create'],
            // Username must be unique
            ['username', 'unique'],
            // Email must be unique
            ['email', 'unique'],
            // Username and email must be in a proper format
            [['username', 'email'], 'trim'],
            [['username', 'email'], 'string', 'max' => 255],
            // Password needs to be validated
            ['password', 'string', 'min' => 6],
        ];
    }

    // Attribute labels for display in forms
    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
        ];
    }

    // Scenarios for different operations
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['username', 'email', 'password'];
        $scenarios['update'] = ['username', 'email'];
        return $scenarios;
    }

    // Method to create a new user
    public function createUser()
    {
        if (!$this->validate()) {
            // Handle validation errors
            return false;
        }

        // Encrypt password before saving
        $this->password = Yii::$app->security->generatePasswordHash($this->password);

        if ($this->save()) {
            // Assign the user a role
            Yii::$app->authManager->assign(
                Yii::$app->authManager->getRole('user'),
                $this->id
            );
            return true;
        } else {
            // Handle save error
            return false;
        }
    }

    // Method to update a user
    public function updateUser()
    {
        if (!$this->validate()) {
            // Handle validation errors
            return false;
        }

        if ($this->password) {
            // Encrypt the password if it's provided
            $this->password = Yii::$app->security->generatePasswordHash($this->password);
        }

        return $this->save();
    }

    // Method to delete a user
    public function deleteUser()
    {
        Yii::$app->authManager->revokeAll($this->id);
        return $this->delete();
    }
}

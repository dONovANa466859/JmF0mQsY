<?php
// 代码生成时间: 2025-10-22 00:42:24
// 引入Yii框架的autoload文件
require(__DIR__ . '/vendor/autoload.php');

use yii\db\Connection;
use yii\db\ActiveRecord;
use yiiase\Model;
use yii\db\Query;
use yii\db\Exception;

// 定义一个学习进度模型
class LearningProgress extends ActiveRecord 
{
    // 定义表名
    public static function tableName()
    {
        return 'learning_progress';
    }
    
    // 定义关联关系
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}

// 定义一个用户模型
class User extends ActiveRecord 
{
    // 定义表名
    public static function tableName()
    {
        return 'users';
    }
    
    // 定义关联关系
    public function getLearningProgress()
    {
        return $this->hasMany(LearningProgress::class, ['user_id' => 'id']);
    }
}

// 定义一个学习进度服务类
class LearningProgressService extends \yiiase\Component
{
    // 定义数据库连接组件ID
    public $db;
    
    // 构造函数
    public function __construct($db, $config = [])
    {
        $this->db = $db;
        parent::__construct($config);
    }
    
    // 获取用户学习进度
    public function getUserLearningProgress($userId)
    {
        try {
            // 构建查询
            $query = new Query();
            $query->select(['progress.*', 'user.username'])
                  ->from(['progress' => LearningProgress::tableName()])
                  ->leftJoin(['user' => User::tableName()], 'user.id = progress.user_id')
                  ->where(['progress.user_id' => $userId]);

            // 执行查询
            $progressData = $query->all($this->db);

            return $progressData;
        } catch (Exception $e) {
            // 错误处理
            Yii::error('Error getting user learning progress: ' . $e->getMessage());
            return null;
        }
    }

    // 更新用户学习进度
    public function updateUserLearningProgress($userId, $progressData)
    {
        try {
            // 构建更新语句
            $command = $this->db->createCommand()->update(LearningProgress::tableName(), $progressData, ['user_id' => $userId]);
            
            // 执行更新
            if ($command->execute() === false) {
                Yii::error('Error updating user learning progress');
                return false;
            }

            return true;
        } catch (Exception $e) {
            // 错误处理
            Yii::error('Error updating user learning progress: ' . $e->getMessage());
            return false;
        }
    }
}

// 定义一个控制器，用于处理学习进度跟踪的请求
class LearningProgressController extends \yii\web\Controller
{
    // 学习进度服务组件
    public $learningProgressService;
    
    // 显示用户学习进度
    public function actionIndex($userId)
    {
        // 获取学习进度数据
        $progressData = $this->learningProgressService->getUserLearningProgress($userId);
        
        if ($progressData === null) {
            // 错误处理
            Yii::error('Error retrieving user learning progress');
            throw new \yii\web\HttpException(500, 'Error retrieving user learning progress');
        }
        
        // 返回学习进度数据
        return $this->render('index', ['progressData' => $progressData]);
    }
    
    // 更新用户学习进度
    public function actionUpdate($userId)
    {
        // 获取请求数据
        $postData = Yii::$app->request->post();
        
        // 更新学习进度
        if ($this->learningProgressService->updateUserLearningProgress($userId, $postData)) {
            // 返回成功响应
            return $this->render('update_success', ['userId' => $userId]);
        } else {
            // 返回错误响应
            throw new \yii\web\HttpException(500, 'Error updating user learning progress');
        }
    }
}

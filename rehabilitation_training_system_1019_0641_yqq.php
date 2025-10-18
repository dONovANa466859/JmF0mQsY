<?php
// 代码生成时间: 2025-10-19 06:41:03
// Import Yii framework components
require_once(basePath . '/vendor/autoload.php');
require_once(basePath . '/vendor/yiisoft/yii2/Yii.php');

// Using Yii components
use yiiase\Application;
use yii\db\ActiveRecord;
use yii\web\Controller;

// Define the base path for the application
defined('basePath') or define('basePath', realpath(dirname(__FILE__)) . '/');

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start the Yii application
$app = new Application([
    'id' => 'rehabilitation-training-system',
    'basePath' => basePath,
    'components' => [
        // Define components such as db, request, user, etc.
        'db' => require(basePath . '/config/db.php'),
    ],
]);

/**
 * Rehabilitation Training Controller
 * Handles all requests related to rehabilitation training.
 */
class TrainingController extends Controller
{
    /**
     * Action to display the training schedule.
     */
    public function actionIndex()
    {
        try {
            // Fetch training schedule from database
            $schedule = TrainingSchedule::find()->all();
            // Return the schedule as JSON
            return \$this->asJson($schedule);
        } catch (\Exception $e) {
            // Handle errors
            return \$this->asJson(['error' => $e->getMessage()]);
        }
    }

    /**
     * Action to add a new training session.
     */
    public function actionAddSession()
    {
        // Get request data
        \$data = \$app->request->getBodyParams();
        try {
            // Create a new training session model
            \$session = new TrainingSession();
            // Load the data into the model
            \$session->load(\$data, '');
            // Validate and save the model
            if (\$session->validate() && \$session->save()) {
                return \$this->asJson(\$session->attributes);
            }
            return \$this->asJson(['error' => 'Failed to add session.']);
        } catch (\Exception \$e) {
            return \$this->asJson(['error' => \$e->getMessage()]);
        }
    }
}

/**
 * ActiveRecord model for Training Schedule
 */
class TrainingSchedule extends ActiveRecord
{
    public static function tableName()
    {
        return 'training_schedule';
    }
}

/**
 * ActiveRecord model for Training Session
 */
class TrainingSession extends ActiveRecord
{
    public static function tableName()
    {
        return 'training_sessions';
    }
}

// Run the application
$app->run();

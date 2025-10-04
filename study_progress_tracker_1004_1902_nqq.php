<?php
// 代码生成时间: 2025-10-04 19:02:54
 * It uses Yii framework to handle the web request and interact with the database.
 *
 * @author Your Name
 * @version 1.0
 */

// Import Yii framework components
require_once("vendor/autoload.php");

// Enable error reporting for development
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

// Bootstrap Yii framework
require("vendor/yiisoft/yii2/Yii.php");

// Create a new Yii application instance
$config = require(__DIR__ . "/config.php");
(new yii\web\Application($config))->run();


// config.php - Configuration file for the Yii application
return [
    "id" => 'study-progress-tracker',
    "basePath" => dirname(__DIR__),
    "components" => [
        "db" => [
            "class" => \yii\db\Connection::class,
            "dsn" => 'mysql:host=localhost;dbname=study_progress_tracker',
            "username" => 'root',
            "password" => '',
            "charset" => 'utf8',
        ],
    ],
];


// models/StudyProgress.php - Model class for study progress
namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "study_progress".
 */
class StudyProgress extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public static function tableName()
    {
        return 'study_progress';
    }

    /**
     * @param int $userId
     * @return StudyProgress[]
     */
    public static function getUserProgress($userId)
    {
        return self::find()->where(['user_id' => $userId])->all();
    }

    /**
     * Saves the study progress for a user.
     * @param array $progressData
     * @return bool
     */
    public function saveProgress($progressData)
    {
        foreach ($progressData as $data) {
            $model = new self;
            $model->setAttributes($data, false);
            if (!$model->save()) {
                return false;
            }
        }
        return true;
    }
}


// controllers/ProgressController.php - Controller for handling study progress actions
namespace app\controllers;

use yii\web\Controller;
use app\models\StudyProgress;
use yii\web\NotFoundHttpException;

/**
 * ProgressController is responsible for handling study progress tracking.
 */
class ProgressController extends Controller
{
    /**
     * Displays the study progress for a user.
     * @param int $id User ID
     * @return string
     */
    public function actionView($id)
    {
        $model = StudyProgress::findOne($id);
        if ($model === null) {
            throw new NotFoundHttpException("Study progress not found.");
        }
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new study progress record.
     * @param int $userId User ID
     * @return string|\yii\web\Response
     */
    public function actionCreate($userId)
    {
        $model = new StudyProgress();
        if (\$_POST) {
            if (\$model->load(\Yii::\$app->request->post()) && \$model->save()) {
                return $this->redirect(["view", "id" => \$model->id]);
            }
        }
        return $this->render('create', [
            'model' => \$model,
        ]);
    }

    /**
     * Updates an existing study progress record.
     * @param int $id Progress ID
     * @return string|\yii\web\Response
     */
    public function actionUpdate($id)
    {
        $model = StudyProgress::findOne($id);
        if ($model === null) {
            throw new NotFoundHttpException("Study progress not found.");
        }
        if (\$_POST) {
            if (\$model->load(\Yii::\$app->request->post()) && \$model->save()) {
                return $this->redirect(["view", "id" => \$model->id]);
            }
        }
        return $this->render('update', [
            'model' => \$model,
        ]);
    }
}


// views/progress/view.php - View file for displaying study progress
/**
 * This view displays the study progress for a user.
 * @var StudyProgress \$model
 */
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var \$this yii\web\View */
/* @var \$model app\models\StudyProgress */
\$this->title = \$model->name;
\$this->params['breadcrumbs'][] = ['label' => 'Study Progress', 'url' => ['index']];
\$this->params['breadcrumbs'][] = \$this->title;
?
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= Html::encode(\$this->title) ?></title>
</head>
<body>
    <h1><?= Html::encode(\$model->name) ?></h1>
    <?php
    echo DetailView::widget([
        'model' => \$model,
        'attributes' => [
            'id',
            'user_id',
            'module',
            'progress',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]);
    ?>
</body>
</html>

<?php
// 代码生成时间: 2025-10-20 11:06:38
// Energy Management System using PHP and Yii Framework
// Filename: energy_management_system.php

require_once("vendor/autoload.php"); // Autoload Yii classes

use Yii;
use yii\base\Component;
use yii\db\ActiveRecord;
use yii\db\Connection;
use yii\db\Query;
use yii\base\Exception;

class EnergySystem extends Component {
    // Database connection property
    public $db;

    // Constructor to initialize database connection
    public function __construct(Connection $db) {
        $this->db = $db;
    }

    // Method to add a new energy record
    public function addEnergyRecord($data) {
        try {
            $energyRecord = new EnergyRecord();
            $energyRecord->attributes = $data;
            if (!$energyRecord->save()) {
                throw new Exception("Failed to add energy record");
            }
            return true;
        } catch (Exception $e) {
            Yii::error("{$e->getMessage()}", __METHOD__);
            return false;
        }
    }

    // Method to retrieve energy records
    public function getEnergyRecords($criteria = []) {
        try {
            $query = new Query();
            $query->from('energy_records')
                  ->where($criteria);
            $records = $query->all($this->db);
            return $records;
        } catch (Exception $e) {
            Yii::error("{$e->getMessage()}", __METHOD__);
            return [];
        }
    }
}

// ActiveRecord class for energy records
class EnergyRecord extends ActiveRecord {
    public static function tableName() {
        return 'energy_records';
    }
}

// Example usage of the EnergySystem class
if (file_exists("config/db.php")) {
    $dbConfig = require_once("config/db.php");
    $db = new Yii\db\Connection($dbConfig);
    $energySystem = new EnergySystem($db);

    // Adding a new energy record
    $newRecord = [
        'source' => 'Solar',
        'amount' => 500,
        'date' => '2023-04-01'
    ];
    $energySystem->addEnergyRecord($newRecord);

    // Retrieving all energy records
    $records = $energySystem->getEnergyRecords();
    print_r($records);
} else {
    echo "Database configuration not found.";
}

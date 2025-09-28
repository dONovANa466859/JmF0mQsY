<?php
// 代码生成时间: 2025-09-29 03:26:26
// api_version_management.php

class ApiVersionManagement {

    private $db; // 数据库连接对象
    private $tableName = 'api_versions'; // 存储API版本的数据表

    // 构造函数，初始化数据库连接
    public function __construct($db) {
        $this->db = $db;
    }

    // 获取所有API版本
    public function getAllVersions() {
        try {
            $sql = "SELECT * FROM {$this->tableName}";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // 错误处理
            error_log($e->getMessage());
            throw new Exception("Failed to fetch API versions: " . $e->getMessage());
        }
    }

    // 添加新的API版本
    public function addVersion($version) {
        try {
            $sql = "INSERT INTO {$this->tableName} (version) VALUES (:version)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':version', $version);
            $stmt->execute();
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            // 错误处理
            error_log($e->getMessage());
            throw new Exception("Failed to add API version: " . $e->getMessage());
        }
    }

    // 更新API版本信息
    public function updateVersion($versionId, $newVersion) {
        try {
            $sql = "UPDATE {$this->tableName} SET version = :newVersion WHERE id = :versionId";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':newVersion', $newVersion);
            $stmt->bindParam(':versionId', $versionId);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            // 错误处理
            error_log($e->getMessage());
            throw new Exception("Failed to update API version: " . $e->getMessage());
        }
    }

    // 删除API版本
    public function deleteVersion($versionId) {
        try {
            $sql = "DELETE FROM {$this->tableName} WHERE id = :versionId";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':versionId', $versionId);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            // 错误处理
            error_log($e->getMessage());
            throw new Exception("Failed to delete API version: " . $e->getMessage());
        }
    }

}

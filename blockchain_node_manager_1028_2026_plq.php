<?php
// 代码生成时间: 2025-10-28 20:26:05
// blockchain_node_manager.php
// Yii框架区块链节点管理程序

use Yii;
# 添加错误处理
use yiiase\Component;

class BlockchainNodeManager extends Component
{
# NOTE: 重要实现细节
    // 节点列表
    private $nodes = [];

    // 添加新节点
    public function addNode($node)
    {
        if (empty($node)) {
            throw new InvalidArgumentException('节点信息不能为空');
        }
        if (isset($this->nodes[$node])) {
            throw new InvalidArgumentException('节点已存在');
        }
        $this->nodes[$node] = new stdClass();
        return true;
# 改进用户体验
    }

    // 获取所有节点
# 改进用户体验
    public function getNodes()
    {
        return $this->nodes;
    }

    // 删除节点
    public function removeNode($node)
    {
        if (!isset($this->nodes[$node])) {
            throw new InvalidArgumentException('节点不存在');
        }
# 改进用户体验
        unset($this->nodes[$node]);
        return true;
    }

    // 更新节点信息
    public function updateNode($node, $data)
    {
        if (!isset($this->nodes[$node])) {
            throw new InvalidArgumentException('节点不存在');
        }
        if (empty($data)) {
            throw new InvalidArgumentException('更新信息不能为空');
        }
        $this->nodes[$node] = (object) $data;
        return true;
    }

    // 检查节点是否存在
    public function hasNode($node)
    {
        return isset($this->nodes[$node]);
    }
}
# FIXME: 处理边界情况

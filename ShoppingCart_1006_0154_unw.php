<?php
// 代码生成时间: 2025-10-06 01:54:21
// ShoppingCart.php
// 购物车类，用于管理用户的购物车信息

class ShoppingCart {

    // 购物车中的商品数据，这里简化为数组形式
    private $items = [];

    // 添加商品到购物车
    public function addItem($product, $quantity) {
        if (!isset($this->items[$product->id])) {
            // 如果商品不在购物车中，则添加
            $this->items[$product->id] = ['product' => $product, 'quantity' => $quantity];
        } else {
            // 如果商品已存在，增加数量
            $this->items[$product->id]['quantity'] += $quantity;
        }
        return true;
    }

    // 从购物车中移除商品
    public function removeItem($productId) {
        if (isset($this->items[$productId])) {
            unset($this->items[$productId]);
            return true;
        }
        return false;
    }

    // 更新购物车中商品的数量
    public function updateQuantity($productId, $quantity) {
        if (isset($this->items[$productId])) {
            if ($quantity <= 0) {
                // 如果更新的数量小于或等于0，则移除商品
                return $this->removeItem($productId);
            }
            $this->items[$productId]['quantity'] = $quantity;
            return true;
        }
        return false;
    }

    // 获取购物车中所有商品
    public function getItems() {
        return $this->items;
    }

    // 清空购物车
    public function clear() {
        $this->items = [];
        return true;
    }

}

// 使用示例
// $cart = new ShoppingCart();
// $product = new Product(1, 'Product Name', 10.99);
// $cart->addItem($product, 2);
// $cart->updateQuantity(1, 1);
// $cart->removeItem(1);
// print_r($cart->getItems());


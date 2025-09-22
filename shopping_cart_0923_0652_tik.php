<?php
// 代码生成时间: 2025-09-23 06:52:33
class ShoppingCart {
    /**
     * @var array The list of items in the shopping cart.
     */
    private $items = [];

    /**
     * Add an item to the shopping cart.
     *
     * @param int $itemId The ID of the item.
     * @param float $price The price of the item.
     * @param int $quantity The quantity of the item.
     * @return void
     */
    public function addItem($itemId, $price, $quantity) {
        if (!isset($this->items[$itemId])) {
            $this->items[$itemId] = [
                'price' => $price,
                'quantity' => 0
            ];
        }
        $this->items[$itemId]['quantity'] += $quantity;
    }

    /**
     * Update an item in the shopping cart.
     *
     * @param int $itemId The ID of the item.
     * @param int $quantity The new quantity of the item.
     * @return void
     */
    public function updateItem($itemId, $quantity) {
        if (!isset($this->items[$itemId])) {
            throw new Exception("Item with ID {$itemId} not found in the cart.");
        }
        if ($quantity <= 0) {
            throw new Exception("Quantity must be greater than zero.");
        }
        $this->items[$itemId]['quantity'] = $quantity;
    }

    /**
     * Remove an item from the shopping cart.
     *
     * @param int $itemId The ID of the item.
     * @return void
     */
    public function removeItem($itemId) {
        if (!isset($this->items[$itemId])) {
            throw new Exception("Item with ID {$itemId} not found in the cart.");
        }
        unset($this->items[$itemId]);
    }

    /**
     * Calculate the total price of the shopping cart.
     *
     * @return float The total price of the cart.
     */
    public function getTotalPrice() {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    /**
     * Get the items in the shopping cart.
     *
     * @return array The list of items in the cart.
     */
    public function getItems() {
        return $this->items;
    }
}

// Example usage:
try {
    $cart = new ShoppingCart();
    $cart->addItem(1, 9.99, 2);
    $cart->addItem(2, 4.99, 1);
    $cart->updateItem(1, 3);
    echo "Total price: " . $cart->getTotalPrice() . "
";
    echo "Items in cart: 
";
    print_r($cart->getItems());
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

<?php

session_start();

require_once __DIR__ . '/../model/product_db.php';
require_once __DIR__ . '/../model/cart.php';

// Make sure the cart exists
initializeCart();

// Process checkout
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {

    clearCart();

    header("Location: /BTStore/catalog.php");
    exit;
}

// Get the current cart
$cart = $_SESSION['cart'];

$cartProducts = [];
$subtotal = 0;

// Build product information for items in the cart
foreach ($cart as $productId => $quantity) {

    if ($quantity > 0) {

        $productId = (int) $productId;

        $product = getProductById($productId);

        if ($product !== null) {

            $product['Quantity'] = $quantity;

            $product['ProductTotal'] =
                calculateProductTotal(
                    $product['ProductCost'],
                    $quantity
                );

            $subtotal += $product['ProductTotal'];

            $cartProducts[] = $product;
        }
    }
}

// Calculate order totals using the Cart Model
$tax = calculateTax($subtotal);

$shipping = calculateShipping($subtotal);

$orderTotal = calculateOrderTotal(
    $subtotal,
    $tax,
    $shipping
);

// Load the Cart View
require_once __DIR__ . '/../view/cart_view.php';
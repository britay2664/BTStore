<?php

session_start();

require_once __DIR__ . '/../model/product_db.php';
require_once __DIR__ . '/../model/cart.php';

// Make sure the shopping cart exists
initializeCart();

// Process catalog actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $productId = (int) ($_POST['product_id'] ?? 0);

    // Add one product
    if (isset($_POST['add_to_cart'])) {
        addToCart($productId);
    }

    // Decrease quantity by one
    if (isset($_POST['decrease_quantity'])) {
        decreaseQuantity($productId);
    }

    // Remove the product completely
    if (isset($_POST['remove_from_cart'])) {
        removeFromCart($productId);
    }

    // Redirect to prevent form resubmission
    header("Location: /BTStore/catalog.php");
    exit;
}

// Get products from the Product Model
$result = getProducts();

// Load the Catalog View
require_once __DIR__ . '/../view/catalog_view.php';
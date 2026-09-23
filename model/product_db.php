<?php

require_once __DIR__ . '/../includes/database.php';

/**
 * Retrieve all products from the database.
 */
function getProducts()
{
    global $conn;

    $sql = "SELECT ProductId, ProductName, ProductDescription, ProductCost
            FROM products
            ORDER BY ProductId";

    return $conn->query($sql);
}

/**
 * Retrieve one product by its Product ID.
 */
function getProductById($productId)
{
    global $conn;

    $productId = (int) $productId;

    $sql = "SELECT ProductId, ProductName, ProductCost
            FROM products
            WHERE ProductId = $productId";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    }

    return null;
}
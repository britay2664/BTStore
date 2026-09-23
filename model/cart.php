<?php

/**
 * Make sure the shopping cart exists.
 */
function initializeCart()
{
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
}

/**
 * Get the quantity of a product currently in the cart.
 */
function getCartQuantity($productId)
{
    return $_SESSION['cart'][$productId] ?? 0;
}

/**
 * Add one of a product to the cart.
 */
function addToCart($productId)
{
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]++;
    } else {
        $_SESSION['cart'][$productId] = 1;
    }
}

/**
 * Decrease a product quantity by one.
 */
function decreaseQuantity($productId)
{
    if (isset($_SESSION['cart'][$productId])) {

        $_SESSION['cart'][$productId]--;

        if ($_SESSION['cart'][$productId] <= 0) {
            unset($_SESSION['cart'][$productId]);
        }
    }
}

/**
 * Remove a product completely from the cart.
 */
function removeFromCart($productId)
{
    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]);
    }
}

/**
 * Remove all products from the cart.
 */
function clearCart()
{
    $_SESSION['cart'] = [];
}

/**
 * Calculate the subtotal for a cart product.
 */
function calculateProductTotal($price, $quantity)
{
    return $price * $quantity;
}

/**
 * Calculate 5% sales tax.
 */
function calculateTax($subtotal)
{
    return $subtotal * 0.05;
}

/**
 * Calculate 10% shipping and handling.
 */
function calculateShipping($subtotal)
{
    return $subtotal * 0.10;
}

/**
 * Calculate the final order total.
 */
function calculateOrderTotal($subtotal, $tax, $shipping)
{
    return $subtotal + $tax + $shipping;
}
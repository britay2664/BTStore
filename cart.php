<?php
session_start();

require_once 'includes/database.php';




if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Process checkout
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {

    // Clear all products from the shopping cart
    $_SESSION['cart'] = [];

    // Return the customer to the catalog
    header("Location: catalog.php");
    exit;
}

$cartProducts = [];
$subtotal = 0;


// Get product information for items currently in the cart
if (!empty($_SESSION['cart'])) {

    foreach ($_SESSION['cart'] as $productId => $quantity) {

        if ($quantity > 0) {

            $productId = (int) $productId;

            $sql = "SELECT ProductId, ProductName, ProductCost
                    FROM products
                    WHERE ProductId = $productId";

            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {

                $product = $result->fetch_assoc();

                $product['Quantity'] = $quantity;
                $product['ProductTotal'] =
                    $product['ProductCost'] * $quantity;

                $subtotal += $product['ProductTotal'];

                $cartProducts[] = $product;
            }
        }
    }
}

// Calculate order totals
$tax = $subtotal * 0.05;
$shipping = $subtotal * 0.10;
$orderTotal = $subtotal + $tax + $shipping;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>BTStore Cart</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <header>
        <h1>BTStore</h1>
        <p>Shopping Cart</p>
    </header>

    <nav>
        <a href="index.php">Home</a>
        <a href="catalog.php">Catalog</a>
        <a href="cart.php">Cart</a>
    </nav>

    <main>

        <h2>Your Shopping Cart</h2>

        <?php if (!empty($cartProducts)): ?>

            <table class="cart-table">

                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Cost</th>
                        <th>Product Total</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($cartProducts as $product): ?>

                        <tr>

                            <td>
                                <?php echo $product['ProductId']; ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($product['ProductName']); ?>
                            </td>

                            <td>
                                <?php echo $product['Quantity']; ?>
                            </td>

                            <td>
                                $<?php echo number_format($product['ProductCost'], 2); ?>
                            </td>

                            <td>
                                $<?php echo number_format($product['ProductTotal'], 2); ?>
                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

            <div class="order-summary">

                <h3>Order Summary</h3>

                <p>
                    <strong>Total of Items Ordered:</strong>
                    $<?php echo number_format($subtotal, 2); ?>
                </p>

                <p>
                    <strong>Tax (5%):</strong>
                    $<?php echo number_format($tax, 2); ?>
                </p>

                <p>
                    <strong>Shipping & Handling (10%):</strong>
                    $<?php echo number_format($shipping, 2); ?>
                </p>

                <p>
                    <strong>Order Total:</strong>
                    $<?php echo number_format($orderTotal, 2); ?>
                </p>

            </div>

            <a class="button" href="catalog.php">
                Continue Shopping
            </a>

            <form method="POST" action="cart.php" class="checkout-form">

                <button type="submit" name="checkout" class="button">
                    Check Out
                </button>

            </form>

            <?php else: ?>

            <p>Your shopping cart is empty.</p>

            <a class="button" href="catalog.php">
                Continue Shopping
            </a>

        <?php endif; ?>

    </main>

    <footer>
        <p>BTStore - SDC310L Course Project</p>
    </footer>

</body>

</html>
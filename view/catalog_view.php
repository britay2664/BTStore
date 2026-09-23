<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>BTStore Catalog</title>

    <link rel="stylesheet" href="/BTStore/css/style.css">
</head>

<body>

    <header>
        <h1>BTStore</h1>
        <p>Product Catalog</p>
    </header>

    <nav>
    <a href="/BTStore/index.php">Home</a>
    <a href="/BTStore/catalog.php">Catalog</a>
    <a href="/BTStore/cart.php">Cart</a>
</nav>

    <main>

        <h2>Product Catalog</h2>

        <p>Select from our available products.</p>

        <div class="products">

            <?php if ($result && $result->num_rows > 0): ?>

                <?php while ($product = $result->fetch_assoc()): ?>

                    <div class="product-card">

                        <h3>
                            <?php echo htmlspecialchars($product['ProductName']); ?>
                        </h3>

                        <p>
                            <strong>Product ID:</strong>
                            <?php echo $product['ProductId']; ?>
                        </p>

                        <p>
                            <?php echo htmlspecialchars($product['ProductDescription']); ?>
                        </p>

                        <p>
                            <strong>Price:</strong>
                            $<?php echo number_format($product['ProductCost'], 2); ?>
                        </p>

                        <p>
                            <strong>Quantity in Cart:</strong>

                            <?php
                            $productId = $product['ProductId'];
                            echo getCartQuantity($productId);
                            ?>
                        </p>

                       <form method="POST" action="/BTStore/catalog.php">

                            <input
                                type="hidden"
                                name="product_id"
                                value="<?php echo $product['ProductId']; ?>"
                            >

                            <button type="submit" name="add_to_cart">
                                + Add
                            </button>

                            <button type="submit" name="decrease_quantity">
                                - Remove One
                            </button>

                            <button type="submit" name="remove_from_cart">
                                Remove All
                            </button>

                        </form>

                    </div>

                <?php endwhile; ?>

            <?php else: ?>

                <p>No products are currently available.</p>

            <?php endif; ?>

        </div>

    </main>

    <footer>
        <p>BTStore - SDC310L Course Project</p>
    </footer>

</body>

</html>
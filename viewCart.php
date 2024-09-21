<?php 
    // Start the session (if not already started)
    session_start();
    error_reporting(0);
    include('partials-front/menu.php'); 
?>

<!-- Custom CSS for cart styling -->
<style>
    /* Container styling */
    .cart {
        padding: 30px 0;
        background: #f5f5f5;
    }

    /* Table styles */
    .tbl-full {
        width: 100%;
        border-collapse: collapse;
        margin: 25px 0;
        font-size: 18px;
        text-align: left;
        background-color: #ffffff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        overflow: hidden;
    }

    .tbl-full th, .tbl-full td {
        padding: 15px;
        border-bottom: 1px solid #ddd;
    }

    .tbl-full th {
        background-color: #f8f8f8;
        font-weight: bold;
    }

    .tbl-full td {
        text-align: center;
    }

    /* Grand total styling */
    .tbl-full .text-right {
        text-align: right;
        padding-right: 20px;
        font-weight: bold;
        color: #333;
    }

    /* Error message styling */
    .error {
        text-align: center;
        color: red;
        font-size: 18px;
    }

    /* Title Styling */
    h2.text-center {
        font-size: 32px;
        font-weight: bold;
        color: #333;
        margin-bottom: 30px;
        position: relative;
    }

    h2.text-center::after {
        content: '';
        width: 50px;
        height: 3px;
        background-color: #f39c12;
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        bottom: -10px;
    }

    /* Button Styling */
    .btn {
        display: inline-block;
        padding: 12px 20px;
        margin: 15px 10px;
        background-color: #3498db;
        color: #ffffff;
        text-decoration: none;
        border-radius: 50px;
        font-size: 18px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .btn-danger {
        background-color: #e74c3c;
    }

    .btn:hover {
        background-color: #2980b9;
    }

    .btn-danger:hover {
        background-color: #c0392b;
    }

    /* Hover effect on rows */
    .tbl-full tr:hover {
        background-color: #f8f8f8;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .tbl-full th, .tbl-full td {
            font-size: 16px;
        }
    }

</style>

<!-- Cart Section Starts Here -->
<section class="cart">
    <div class="container">
        <h2 class="text-center text-white">Your Cart</h2>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Food</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>

            <?php 
                // Check if the cart is not empty
                if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                    $sn = 1;
                    $grand_total = 0;

                    // Loop through all cart items
                    foreach($_SESSION['cart'] as $item) {
                        $food = $item['food'];
                        $price = $item['price'];
                        $qty = $item['qty'];
                        $total = $item['total'];

                        // Calculate grand total
                        $grand_total += $total;

                        ?>

                        <tr>
                            <td><?php echo $sn++; ?>.</td>
                            <td><?php echo $food; ?></td>
                            <td>₹<?php echo $price; ?></td>
                            <td><?php echo $qty; ?></td>
                            <td>₹<?php echo $total; ?></td>
                        </tr>

                        <?php
                    }
                } else {
                    // If cart is empty
                    echo "<tr><td colspan='5' class='error'>Your cart is empty.</td></tr>";
                }
            ?>

            <!-- Display grand total if there are items -->
            <?php if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                <tr>
                    <td colspan="4" class="text-right"><strong>Grand Total</strong></td>
                    <td>₹<?php echo $grand_total; ?></td>
                </tr>
            <?php endif; ?>
        </table>

        <!-- Optional: Add buttons to checkout or continue ordering -->
        <div class="text-center">
            <?php if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                <a href="invoice.php" class="btn btn-primary">Proceed to Checkout</a>
                <a href="clearCart.php" class="btn btn-danger">Clear Cart</a>
            <?php endif; ?>
        </div>

    </div>
</section>
<!-- Cart Section Ends Here -->

<?php include('partials-front/footer.php'); ?>

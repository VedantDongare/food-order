<?php
    // Start the session (if not already started)
    session_start();
    error_reporting(0);

    // Check if the cart session exists
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        echo "<script>
                alert('Your cart is empty. Please add items to the cart.');
                window.location.href = 'viewCart.php';
              </script>";
        exit();
    }

    // Include the menu/header
    include('partials-front/menu.php'); 
?>

<style>
    /* Styling for the Invoice Section */
.invoice {
    background-color: #f7f7f7;
    padding: 40px 0;
    min-height: 100vh;
}

.invoice h2 {
    font-size: 36px;
    margin-bottom: 30px;
    color: #333;
    font-weight: 700;
    text-transform: uppercase;
}

.tbl-full {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 30px;
}

.tbl-full th, .tbl-full td {
    padding: 15px;
    text-align: center;
    border: 1px solid #ddd;
    font-size: 16px;
}

.tbl-full th {
    background-color: #333;
    color: white;
    font-weight: bold;
}

.tbl-full tr:nth-child(even) {
    background-color: #f2f2f2;
}

.tbl-full td {
    background-color: #fff;
}

.tbl-full tr:hover {
    background-color: #f9f9f9;
}

.tbl-full .text-right {
    text-align: right;
    padding-right: 20px;
}

.invoice .payment-form {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

.payment-form h3 {
    font-size: 28px;
    margin-bottom: 20px;
    color: #333;
}

.payment-form div {
    margin-bottom: 15px;
}

.payment-form label {
    font-size: 18px;
    display: block;
    margin-bottom: 5px;
    color: #555;
}

.payment-form select, 
.payment-form input {
    width: 100%;
    padding: 10px;
    border-radius: 4px;
    border: 1px solid #ddd;
    font-size: 16px;
}

.payment-form input:focus, 
.payment-form select:focus {
    border-color: #333;
    outline: none;
}

.payment-form .btn-success {
    background-color: #28a745;
    color: white;
    padding: 12px 30px;
    border: none;
    border-radius: 4px;
    font-size: 18px;
    cursor: pointer;
}

.payment-form .btn-success:hover {
    background-color: #218838;
}

.payment-form .btn-success:active {
    background-color: #1e7e34;
}

/* Media Query for Mobile Responsiveness */
@media (max-width: 768px) {
    .invoice h2 {
        font-size: 28px;
    }

    .tbl-full th, .tbl-full td {
        font-size: 14px;
        padding: 10px;
    }

    .payment-form h3 {
        font-size: 24px;
    }

    .payment-form input, 
    .payment-form select {
        font-size: 14px;
    }

    .payment-form .btn-success {
        font-size: 16px;
        padding: 10px 20px;
    }
}

</style>

<!-- Invoice Section Starts Here -->
<section class="invoice">
    <div class="container">
        <h2 class="text-center text-white">Invoice</h2>

        <!-- Display Cart Items as Invoice -->
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Food</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>

            <?php 
                $sn = 1;
                $grand_total = 0;

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
            ?>

            <!-- Display grand total -->
            <tr>
                <td colspan="4" class="text-right"><strong>Grand Total</strong></td>
                <td>₹<?php echo $grand_total; ?></td>
            </tr>
        </table>

        <!-- Payment Form Starts Here -->
        <h3 class="text-center">Payment Process</h3>

        <!-- Simulated Payment Form -->
        <form action="processPayment.php" method="POST" class="payment-form text-center">
            <div>
                <label for="payment-method">Select Payment Method:</label>
                <select name="payment_method" id="payment-method" required>
                    <option value="credit-card">Credit Card</option>
                    <option value="debit-card">Debit Card</option>
                </select>
            </div>

            <div>
                <label for="card-number">Card Number:</label>
                <input type="text" name="card_number" id="card-number" required placeholder="Enter Card Number">
            </div>

            <div>
                <label for="card-expiry">Expiry Date:</label>
                <input type="month" name="card_expiry" id="card-expiry" required>
            </div>

            <div>
                <label for="card-cvc">CVC:</label>
                <input type="text" name="card_cvc" id="card-cvc" required placeholder="Enter CVC">
            </div>

            <!-- Hidden field for grand total -->
            <input type="hidden" name="grand_total" value="<?php echo $grand_total; ?>">

            <!-- Payment Submit Button -->
            <button type="submit" class="btn btn-success">Pay Now (₹<?php echo $grand_total; ?>)</button>
        </form>
        <!-- Payment Form Ends Here -->

    </div>
</section>
<!-- Invoice Section Ends Here -->

<?php include('partials-front/footer.php'); ?>

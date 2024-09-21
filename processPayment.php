<?php
    // Start the session
    session_start();
    include('config/constants.php'); // Ensure your database connection is included

    // Check if the payment method is set
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $payment_method = $_POST['payment_method'];
        $card_number = $_POST['card_number'];
        $card_expiry = $_POST['card_expiry'];
        $card_cvc = $_POST['card_cvc'];
        $grand_total = $_POST['grand_total'];
        $user_id = $_SESSION['u_id']; // Assuming user ID is stored in session

        // Simulate successful payment process
        // In a real-world app, this is where you'd integrate an actual payment gateway

        // Insert each cart item as an order in the database
        foreach($_SESSION['cart'] as $item) {
            $food = $item['food'];
            $price = $item['price'];
            $qty = $item['qty'];
            $total = $item['total'];

            $order_date = date("Y-m-d H:i:s");
            $status = "Ordered"; // Default status as "Ordered"

            // Prepare SQL query to insert the order into `tbl_order`
            $sql = "INSERT INTO tbl_order (u_id, food, price, qty, total, order_date, status) 
                    VALUES ('$user_id', '$food', '$price', '$qty', '$total', '$order_date', '$status')";

            // Execute the query
            $res = mysqli_query($conn, $sql);

            // Check if the query was successful
            if(!$res) {
                echo "<script>
                        alert('Failed to place your order. Please try again.');
                        window.location.href = 'viewCart.php';
                      </script>";
                exit();
            }
        }

        // Clear the cart after successful payment
        unset($_SESSION['cart']);

        // Display a success message and redirect to myorders.php
        echo "<script>
                alert('Payment Successful! Your order has been placed.');
                window.location.href = 'myorders.php';
              </script>";
    } else {
        echo "<script>
                alert('Invalid payment process.');
                window.location.href = 'viewCart.php';
              </script>";
    }
?>

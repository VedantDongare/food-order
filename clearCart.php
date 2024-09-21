<?php
    // Start the session (if not already started)
    session_start();

    // Check if the cart session is set
    if(isset($_SESSION['cart'])) {
        // Clear the cart by unsetting the session variable
        unset($_SESSION['cart']);
        
        // Optional: You can also destroy the entire session if needed
        // session_destroy(); // This would log the user out as well, use only if required

        // Redirect to cart page with a success message
        echo "<script>
                alert('Your cart has been cleared.');
                window.location.href = 'viewCart.php';
              </script>";
    } else {
        // If the cart is already empty or not set, redirect with an appropriate message
        echo "<script>
                alert('Your cart is already empty.');
                window.location.href = 'viewCart.php';
              </script>";
    }
?>

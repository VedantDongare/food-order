<?php include('partials-front/menu.php'); ?>

<?php 
    //CHeck whether food id is set or not
    if(isset($_GET['food_id']))
    {
        //Get the Food id and details of the selected food
        $food_id = $_GET['food_id'];

        //Get the Details of the Selected Food
        $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
        //Execute the Query
        $res = mysqli_query($conn, $sql);
        //Count the rows
        $count = mysqli_num_rows($res);
        //Check whether the data is available or not
        if($count==1)
        {
            //We have Data
            //Get the Data from Database
            $row = mysqli_fetch_assoc($res);

            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];
        }
        else
        {
            //Food not Available
            //Redirect to Home Page
            header('location:'.SITEURL);
        }
    }
    else
    {
        //Redirect to homepage
        header('location:'.SITEURL);
    }
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-order">
    <div class="container">        
        <h2 class="text-center text-white">Please confirm to place order</h2>

        <form action="" method="POST" class="order">
            <fieldset>
                <legend style="color:white;">Selected Food</legend>

                <div class="food-menu-img">
                    <?php 
                    
                        //Check whether the image is available or not
                        if($image_name=="")
                        {
                            //Image not Available
                            echo "<div class='error'>Image not Available.</div>";
                        }
                        else
                        {
                            //Image is Available
                            ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Food Image" class="img-responsive img-curve">
                            <?php
                        }
                    
                    ?>
                    
                </div>

                <div class="food-menu-desc">
                    <h3 style="color:white;"><?php echo $title; ?></h3>
                    <input type="hidden" name="food" value="<?php echo $title; ?>">

                    <p class="food-price" style="color:white;">₹<?php echo $price; ?></p>
                    <input type="hidden" name="price" value="<?php echo $price; ?>">

                    <div class="order-label" style="color:white;">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>
                    
                </div>

            </fieldset>
            
            <fieldset>
                <input type="submit" name="submit" value="Add to Cart" class="btn btn-primary">
            </fieldset>

        </form>

        <?php
    //Check whether submit button is clicked or not
    if(isset($_POST['submit']))
    {
        if(empty($_SESSION["u_id"]))
        {
            header('location:login.php');
        }
        else
        {
            // Get all the details from the form
            $food = $_POST['food'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];

            // Create an item array to store in the cart
            $cart_item = array(
                'food' => $food,
                'price' => $price,
                'qty' => $qty,
                'total' => $price * $qty
            );

            // Add the item to the session
            if(!isset($_SESSION['cart'])) {
                // If cart is not set, create a new array
                $_SESSION['cart'] = array();
            }

            // Add the current item to the cart session
            array_push($_SESSION['cart'], $cart_item);

            // Redirect to viewCart.php after adding to cart
            echo "<script>
                    alert('Your order has been added to the cart');
                    window.location.href = 'viewCart.php';
                  </script>";
        }
    }
?>


    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php include('partials-front/footer.php'); ?>

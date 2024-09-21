<style>
    /* General Styles */
body {
    font-family: 'Roboto', sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
}

.wrapper {
    max-width: 1200px;
    margin: auto;
    padding: 20px;
}

h1 {
    color: #333;
    font-size: 2.5rem;
    text-align: center;
    margin-bottom: 20px;
}

/* Dashboard row layout */
.row {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    margin-top: 40px;
}

.col {
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 22%;
    margin: 15px;
    padding: 30px;
    transition: transform 0.3s ease;
}

.col:hover {
    transform: scale(1.05);
}

.text-center {
    text-align: center;
    padding: 10px;
}

/* Styling for numbers (counts) */
.col h1 {
    font-size: 2.5rem;
    color: #27ae60;
    margin-bottom: 2px;
}

.col p {
    font-size: 1.2rem;
    color: #666;
}

/* Specific style for revenue */
.col h1.revenue {
    color: #e74c3c;
}

/* Clearfix */
.clearfix {
    clear: both;
}

/* Button Styles */
button {
    background-color: #27ae60;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #219150;
}

/* Footer Styling */
footer {
    text-align: center;
    background-color: #333;
    color: white;
    padding: 20px;
    position: absolute;
    bottom: 0;
    width: 100%;
}

footer p {
    margin: 0;
    font-size: 0.9rem;
}

/* Responsive Design */
@media screen and (max-width: 768px) {
    .col {
        width: 45%;
        margin: 10px 0;
    }
}

@media screen and (max-width: 500px) {
    .col {
        width: 90%;
    }
}

</style>

<?php include('partials/menu.php'); ?>

        <!-- Main Content Section Starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Dashboard</h1>
                <br><br>
                <?php 
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
                <br><br>
                <div class="row">
                <div class="col text-center">

                    <?php 
                        //Sql Query 
                        $sql = "SELECT * FROM tbl_category";
                        //Execute Query
                        $res = mysqli_query($conn, $sql);
                        //Count Rows
                        $count = mysqli_num_rows($res);
                    ?>

                    <h1><?php echo $count; ?></h1>
                    <br />
                    Categories
                </div>

                <div class="col text-center">

                    <?php 
                        //Sql Query 
                        $sql2 = "SELECT * FROM tbl_food";
                        //Execute Query
                        $res2 = mysqli_query($conn, $sql2);
                        //Count Rows
                        $count2 = mysqli_num_rows($res2);
                    ?>

                    <h1><?php echo $count2; ?></h1>
                    <br />
                    Foods
                </div>

                <div class="col text-center">
                    
                    <?php 
                        //Sql Query 
                        $sql3 = "SELECT * FROM tbl_order";
                        //Execute Query
                        $res3 = mysqli_query($conn, $sql3);
                        //Count Rows
                        $count3 = mysqli_num_rows($res3);
                    ?>

                    <h1><?php echo $count3; ?></h1>
                    <br />
                    Total Orders
                </div>
                <div class="col text-center">
                    
                    <?php 
                        //Sql Query 
                        $sql3 = "SELECT * FROM users";
                        //Execute Query
                        $res3 = mysqli_query($conn, $sql3);
                        //Count Rows
                        $count3 = mysqli_num_rows($res3);
                    ?>

                    <h1><?php echo $count3; ?></h1>
                    <br />
                    Total Users
                </div>

                <div class="col text-center">
                    
                    <?php 
                        //Creat SQL Query to Get Total Revenue Generated
                        //Aggregate Function in SQL
                        $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";

                        //Execute the Query
                        $res4 = mysqli_query($conn, $sql4);

                        //Get the VAlue
                        $row4 = mysqli_fetch_assoc($res4);
                        
                        //GEt the Total REvenue
                        $total_revenue = $row4['Total'];

                    ?>

                    <h1>₹<?php echo $total_revenue; ?></h1>
                    <br />
                    Revenue Generated
                </div>
                </div>

                <div class="clearfix"></div>
                <br><br><br><br>

            </div>
        </div>
        <!-- Main Content Setion Ends -->

<?php include('partials/footer.php') ?>
<?php 

    include('../config/constants.php'); 
    include('login-check.php');

?>


<html>
    <head>
        <title>Food Order Website - Home Page</title>
        <link rel="stylesheet" href="../css/admin.css">
        <link rel="stylesheet" href=
    "https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
            integrity=
    "sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
            crossorigin="anonymous"> 
     
        <style>
            /* Menu Styles */
.menu {
    padding: 15px 0;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.menu .wrapper {
    max-width: 1200px;
    margin: auto;
}

.menu ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
}

.menu ul li {
    margin: 0 20px;
}

.menu ul li a {
    text-decoration: none;
    font-size: 1.2rem;
    color: black;
    padding: 10px 20px;
    border-radius: 5px;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.menu ul li a:hover {
    transform: translateY(-5px);
}

/* Responsive Menu */
@media (max-width: 768px) {
    .menu ul {
        flex-direction: column;
        padding: 0;
    }

    .menu ul li {
        margin-bottom: 10px;
    }

    .menu ul li a {
        font-size: 1rem;
        padding: 10px 15px;
    }
}

        </style>
    </head>
    
    <body>
        <!-- Menu Section Starts -->
        <div class="menu text-center">
            <div class="wrapper">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="manage-users.php">Users</a></li>
                    <li><a href="manage-category.php">Category</a></li>
                    <li><a href="manage-food.php">Food</a></li>
                    <li><a href="manage-order.php">Order</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
        <!-- Menu Section Ends -->
<!DOCTYPE html>
<html>
    <style>
        .menu {
        overflow: hidden;
        background-color: #767FA7;
        position: fixed; /* Set the navbar to fixed position */
        top: 0; /* Position the navbar at the top of the page */
        width: 100%; /* Full width */
        }
        /* Links inside the navbar */
        .menu a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        /* Change background on mouse-over */
        .menu a:hover {
            background: pink;
            color: black;
        }
        /* Main content */
        .main {
            margin-top: 60px; /* Add a top margin to avoid content overlay */
        }
    </style>
    <?php
        echo '<a href="/~cs332u7/home.html">Home</a>
        <a href="/~cs332u7/insert_item.php">Add Item</a>
        <a href="/~cs332u7/expiration.php">Expiration</a>
        <a href="/~cs332u7/lowstock.php">Low Stock</a>
        <a href="/~cs332u7/buyitem.php">Buy Item</a>
        <a href="/~cs332u7/totaltransaction.php">Transaction Total</a>
        <a href="/~cs332u7/receivedelivery.php">Delivery</a>
        <a href="/~cs332u7/order.php">Order</a>
        <a href="/~cs332u7/view_database.php">View Database</a>';
    ?>
    <?php
        // echo '<a href="/~cs332u7/home.html">Home</a> -
        // <a href="/~cs332u7/insert_item.php">Add Item</a> -
        // <a href="/~cs332u7/expiration.php">Expiration</a> - 
        // <a href="/~cs332u7/lowstock.php">Low Stock</a> - 
        // <a href="/~cs332u7/buyitem.php">Buy Item</a> -
        // <a href="/~cs332u7/totaltransaction.php">Transaction Total</a> -
        // <a href="/~cs332u7/receivedelivery.php">Delivery</a> -
        // <a href="/~cs332u7/order.php">Order</a> -
        // <a href="/~cs332u7/view_database.php">View Database</a>';
    ?>
</html>
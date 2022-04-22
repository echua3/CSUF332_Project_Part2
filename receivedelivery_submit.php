<!-- Receive Delivery (25 points)
Takes a Delivery ID
Should remove The delivery and any orders associated with it from the database
Should add the number of each item received to the stock of that item -->
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="/~cs332u7/table.css">
        <title>Delivery Arrival</title>
    </head>

    <div class="menu">
        <?php include 'menu.php';?>
    </div>

    <h1>Delivery Receival</h1>
    
    <body>
        <?php
            require_once('connect.php');
            $delivery_id = $_POST['Delivery_ID'];
            echo $delivery_id;
        ?>
    </body>

</html>
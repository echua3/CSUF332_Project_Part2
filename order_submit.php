<!-- Place order by an employee (25 points)
Should take an employee id, item id, and amount of the item to order
If the employee’s permission level is 0 return a message saying they do not have 
permission and reject the order
If the employee does have permission then add the order to the database with the
 order not having been added to a delivery yet -->
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="/~cs332u7/table.css">
        <title>Employee Order</title>
    </head>

    <div class="menu">
        <?php include 'menu.php';?>
    </div>

    <h1>Order</h1>

    <body>
        <div class="table-wrapper">
            <?php
                require_once('connect.php');
                $employee = $_POST['Employee_ID'];
                $employee_permission = 0;

                // CHECK EMPLOYEE PERMISSION
                $sql = "SELECT Permission_Level FROM EMPLOYEE
                WHERE ID = '$employee'";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()) { 
                    $employee_permission = $row['Permission_Level'];             
                }
                if ($employee_permission == 1) {
                    // echo $employee_permission . "<br>";
                    // MAKE NEW ORDER
                    $item_UPC = $_POST['Item_UPC'];
                    $amount = $_POST['amount'];
                    $order_date = date("Y-m-d");
                    $delivery_status = 'no';
                    
                    $sql = "INSERT INTO `ORDER`(Item_UPC, Amount_of_Item, 
                    Order_Date, Delivery_Status) 
                    VALUES ('$item_UPC', $amount, '$order_date', 
                    '$delivery_status')";
                    //$result = $conn->query($sql);
                    if (mysqli_query($conn, $sql)) {
                        //echo "Query Successful" . "<br>";
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn) 
                        . "<br>";
                    }

                    // PRINT ORDER
                    $sql = "SELECT * FROM `ORDER`
                    WHERE Item_UPC = '$item_UPC' AND Amount_of_Item = $amount
                    AND Order_Date = '$order_date' AND Delivery_Status = 'no'";
                    $order = $conn->query($sql);
                    // echo $sql;
            ?>
            <table class="fl-table">
                <caption>New Order</caption>
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Delivery Status</th>
                        <th>Delivery ID</th>
                    </tr>
                </thead>
                <?php
                    if ($order->num_rows > 0) {
                        // output data of each row
                        echo "<tbody>";
                        while($row = $order->fetch_assoc()) {   
                            echo "<tr>";
                            echo "<td>" . $row['Item_UPC'] . "</td>";
                            echo "<td>" . $row['Amount_of_Item'] . "</td>";
                            echo "<td>" . $row['Order_Date'] . "</td>";
                            echo "<td>" . $row['Delivery_Status'] . "</td>";
                            echo "<td>" . $row['Delivery_ID'] . "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                    } else {
                        echo "0 Orders";
                    }
                    
                ?>
            </table>
            <?php
                } else {
                    // NO PERMISSION
                    echo "<b>Order Rejected. Must have permission.</b>
                    <br /><hr />";
                }

                // PRINT ALL ORDER
                $sql = "SELECT * FROM `ORDER`";
                $orders = $conn->query($sql);
            ?>
            <table class="fl-table">
                <caption>All Orders</caption>
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Delivery Status</th>
                        <th>Delivery ID</th>
                    </tr>
                </thead>
                <?php
                    if ($orders->num_rows > 0) {
                        // output data of each row
                        echo "<tbody>";
                        while($row = $orders->fetch_assoc()) {   
                            echo "<tr>";
                            echo "<td>" . $row['Item_UPC'] . "</td>";
                            echo "<td>" . $row['Amount_of_Item'] . "</td>";
                            echo "<td>" . $row['Order_Date'] . "</td>";
                            echo "<td>" . $row['Delivery_Status'] . "</td>";
                            echo "<td>" . $row['Delivery_ID'] . "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                    } else {
                        echo "0 Orders";
                    }
                    
                ?>
            </table>
        </div>
    </body>

</html>
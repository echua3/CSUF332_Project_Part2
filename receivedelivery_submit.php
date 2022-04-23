<!-- Receive Delivery (25 points)
Takes a Delivery ID
Should remove the delivery and any orders associated with it from the database
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
            // echo $delivery_id;
            $sql = "SELECT * FROM DELIVERY AS D, `ORDER` AS O, ITEM AS I
            WHERE D.ID = '$delivery_id' AND O.Delivery_ID = D.ID 
            AND I.UPC = O.Item_UPC";
            $items = $conn->query($sql);
            // echo $sql;

            if (mysqli_query($conn, $sql)) {
                //echo "Query Successful" . "<br>";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        ?>
        <div class="table-wrapper">
            <div style=“padding-bottom: 100px”>
                <table class="fl-table">
                    <!-- <table border = '2'> -->
                    <caption>Items in Delivery ID = <?=$delivery_id?> </caption>
                    <thead> 
                        <tr>
                        <th>Item UPC</th>
                        <th>Order Amount</th>
                        <th>Current Stock</th>
                        <th>New Total</th>
                        </tr>
                    </thead>
                    <?php
                        if ($items->num_rows > 0) {
                            // output data of each row
                            while($row = $items->fetch_assoc()) {
                                // GET VALUES
                                $item = $row['Item_UPC'];
                                $amount_of_item = $row['Amount_of_Item'];
                                $order_date = $row['Order_Date'];
                                $delivery_status = $row['Delivery_Status'];

                                // PUT DATA IN TABLE
                                echo "<tr>";
                                echo "<td>" . $item . "</td>";
                                echo "<td>" . $amount_of_item . "</td>";
                                echo "<td>" . $row['Current_Stock'] . "</td>";
                                $total_stock = $row['Current_Stock'] + $row['Amount_of_Item'];
                                echo "<td>" . $total_stock . "</td>";
                                echo "</tr>";

                                // UPDATE ITEM CURRENT STOCK
                                $sql = "UPDATE ITEM
                                SET Current_Stock = $total_stock
                                WHERE ITEM.UPC = '$item'";
                                $update = $conn->query($sql);
                                if (mysqli_query($conn, $sql)) {
                                    //echo "Query Successful" . "<br>";
                                } else {
                                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                }

                                // REMOVE ORDER
                                $sql = "DELETE FROM `ORDER`
                                    WHERE Item_UPC = '$item' 
                                    AND Amount_of_Item = $amount_of_item
                                    AND Order_Date = '$order_date'
                                    AND Delivery_Status = '$delivery_status'";
                                $remove = $conn->query($sql);
                                if (mysqli_query($conn, $sql)) {
                                    //echo "Query Successful" . "<br>";
                                } else {
                                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                }

                            }
                        } else {
                            echo "<tr>";
                            echo "<strong><td>0 items in delivery</td></strong>";
                            echo "</tr>";
                        }

                        // REMOVE DELIVERY
                        $sql = "DELETE FROM DELIVERY
                                WHERE ID = '$delivery_id'";
                        $remove = $conn->query($sql);
                        if (mysqli_query($conn, $sql)) {
                            //echo "Query Successful" . "<br>";
                        } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }
                    ?>
                </table>
            </div>
            <?php
                $sql = "SELECT * FROM ITEM";
                $items = $conn->query($sql);
                // echo $sql;

                if (mysqli_query($conn, $sql)) {
                    //echo "Query Successful" . "<br>";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            ?>
            <table class="fl-table">
                <caption>Updated Items</caption>
                <thead> 
                    <tr>
                    <th>Item UPC</th>
                    <th>Current Stock</th>
                    </tr>
                </thead>
            <?php
                if ($items->num_rows > 0) {
                    // output data of each row
                    while($row = $items->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['UPC'] . "</td>";
                    echo "<td>" . $row['Current_Stock'] . "</td>";
                    echo "</tr>";
                    }
                } else {
                    echo "<tr>";
                    echo "<td>" . "0 items";
                    echo "</tr>";
                }
            ?>
            </table>
            <?php
                $sql = "SELECT * FROM DELIVERY";
                $all_deliveries = $conn->query($sql);
                // echo $sql;

                if (mysqli_query($conn, $sql)) {
                    //echo "Query Successful" . "<br>";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            ?>
            <table class="fl-table">
                <caption>Remaining Deliveries</caption>
                <thead>
                    <tr>
                        <th>Delivery ID</th>
                        <th>Arrival</th>
                        <th>Pallet Amount</th>
                        <th>Truck Number</th>
                    </tr>
                </thead>
                <?php
                    if ($all_deliveries->num_rows > 0) {
                        // output data of each row
                        echo "<tbody>";
                        while($row = $all_deliveries->fetch_assoc()) {   
                            echo "<tr>";
                            echo "<td>" . $row['ID'] . "</td>";
                            echo "<td>" . $row['Arrival_Date'] . "</td>";
                            echo "<td>" . $row['Pallet_Amount'] . "</td>";
                            echo "<td>" . $row['Truck_Number'] . "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                    } else {
                        echo "0 Deliveries";
                    }
                ?>
            </table>
            <?php
                require_once('connect.php');
                $sql = "SELECT * FROM `ORDER`
                ORDER BY `ORDER`.Order_Date";
                $all_items = $conn->query($sql);
            ?>
            <table class="fl-table">
                <caption>Remaining Orders</caption>
                <thead>
                    <tr>
                        <th>Item UPC</th>
                        <th>Amount of Item</th>
                        <th>Order Date</th>
                        <th>Delivery Status</th>
                        <th>Delivery ID</th>
                    </tr>
                </thead>
                <?php
                    if ($all_items->num_rows > 0) {
                        // output data of each row
                        echo "<tbody>";
                        while($row = $all_items->fetch_assoc()) {   
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
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
            $sql = "SELECT * FROM DELIVERY
            ORDER BY DELIVERY.Arrival_Date";
            $all_deliveries = $conn->query($sql);
        ?>
        <div class="table-wrapper">
            <table class="fl-table">
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
            <br />
            <hr />
            <h2>Select Delivery:</h2>
            <form action="receivedelivery_submit.php" method="post">
                <label>Delivery ID: </label>
                <select name="Delivery_ID">
                    <?php 
                        // use a while loop to fetch data 
                        $sql = "SELECT ID FROM DELIVERY";
                        $all_deliveries = $conn->query($sql);
                        while ($delivery = mysqli_fetch_array($all_deliveries, MYSQLI_ASSOC)):; 
                    ?>
                        <option value="<?php echo $delivery["ID"]; // primary key
                        ?>"
                        >
                        <?php echo $delivery["ID"];
                            // To show the category name to the user
                        ?>
                    </option>
                    <?php 
                        endwhile; //terminate while loop
                    ?>
                </select>
                <input type="submit">
            </form>
            <p style='text-align:center'> Updates the item inventory and removes the delivery and associated 
                orders.
            </p>
        </div>
    </body>

</html>
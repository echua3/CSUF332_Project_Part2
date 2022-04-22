<!-- Total transaction (25 points)
Takes a transaction and a customer id
Should calculate the total for the transaction given
Returns 0 if the transaction does not exist  -->
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="/~cs332u7/table.css">
        <title> Transaction Total </title>
    </head>

    <div class="menu">
        <?php include 'menu.php';?>
    </div>
    <h1>Transaction Total</h1>
    <body>
        <?php
            require_once('connect.php');
        ?>
        <div class="table-wrapper">
            <?php
                $customer_phone = $_POST['customer_phone_number'];
                $transaction_ID = $_POST['transaction_ID'];
                $total_price = 0;
                $sql = "SELECT * FROM PURCHASE
                WHERE PURCHASE.Transaction_ID = '$transaction_ID' AND 
                PURCHASE.Customer_Phone_Number = '$customer_phone'";
                $response = $conn->query($sql);
                // echo $sql;
            ?>
            <table class="fl-table">
                <caption> Transaction #<?=$_POST['transaction_ID']?> 
        from <?=$_POST['customer_phone_number']?> </caption>
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Number Bought</th>
                        <th>Price Paid</th>
                    </tr>
                </thead>
                <?php
                    if ($response->num_rows > 0) {
                        // output data of each row
                        while($row = $response->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['Item_UPC'] . "</td>";
                            echo "<td>" . $row['Number_Bought'] . "</td>";
                            echo "<td>$" . $row['Price_Paid'] . "</td>";
                            echo "</tr>";
                            $total_price = $total_price + ($row['Price_Paid'] * $row['Number_Bought']);
                        }
                    } else {
                        echo "<tr>";
                        echo "<td>" . "0 items in transaction";
                        echo "</tr>";
                    }
                ?>
            </table>
            <p> 
                <strong>
                    <?php
                        echo "Total Price: $" . $total_price;
                    ?>
                </strong>
            </p>
        </div>
    </body>
</html>
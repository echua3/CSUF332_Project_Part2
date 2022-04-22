<!--  Buy item(30points)
○ Should take an item id, customer id, and transaction id and add the item to
the transaction.
○ If no transaction id is given then a new transaction is started for the
customer.
-->
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/~cs332u7/table.css">
    <title>Buy Item</title>
</head>

<div class="menu">
    <?php include 'menu.php';?>
</div>

<h1>Added <?=$_POST['UPC']?> to <?=$_POST['transaction_ID']?> Transaction</h1>

<body>
    <div class="table-wrapper">
        <?php
            require_once('connect.php');
            // get variables from input
            $upc = $_POST['UPC'];
            $amount = (int)$_POST['amount'];
            $itemprice = $_POST['price'];
            $price = 0;
            $interim_price = 0;
            $wholesale_price = 0;
            $customer_phone = $_POST['customer_phone_number'];
            $transaction_ID = $_POST['transaction_ID'];

            $sql_p = "SELECT * FROM ITEM 
            WHERE ITEM.UPC = '$upc'";
            $result = $conn->query($sql_p);


            // get item price info    
            while($row = $result->fetch_assoc()) {
                $price = $row['Price'];
                $interim_price = $row['Interim_Price'];
                $wholesale_price = $row['Wholesale_Price'];
            }
            // echo $price . "<br>";
            // echo $interim_price . "<br>";
            // echo $wholesale_price . "<br>";

            // set transaction price
            if (strcmp($itemprice, "price") == 0) {
                // $price = $price;
            } else if (strcmp($itemprice, "interim_price") == 0) {
                $price = $interim_price;
            } else {
                $price = $wholesale_price;
            }

            // echo $price . "<br>";
            // echo $customer_phone . "<br>";
            // echo $transaction_ID . "<br>";

            // if(strcmp($transaction_ID, "New") == 0){
            //     include('createtransaction.php');
            //     createtransaction($customer_phone);
            // }

            // create new transaction if transaction_ID = new
            if(strcmp($transaction_ID,"New") == 0){
                $sql = "SELECT Count(*) FROM TRANSACTION
                WHERE TRANSACTION.Customer_Phone_Number = $customer_phone";
                $result = $conn->query($sql);
                $num_transactions = $result->fetch_assoc()['Count(*)'];
                // echo $num_transactions . "<br>";
                // echo sprintf('%02d', $num_transactions + 1) . "<br>";
                $transaction_ID = "TRANS" . sprintf('%02d', $num_transactions + 1);
                // echo $transaction_ID;
                $transaction_date = date("Ymd");
                $transaction_time = date("H:i:s");
            
                $sql = "INSERT INTO TRANSACTION
                VALUES ('$transaction_ID','$customer_phone', '$transaction_date',
                '$transaction_time')";
            
                if (mysqli_query($conn, $sql)) {
                    // echo "New transaction created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            
                // query to get all customer transactions
                // $sql = "SELECT * FROM TRANSACTION
                // WHERE TRANSACTION.Customer_Phone_Number = $customer_phone";
                // $result = $conn->query($sql);
            
                // while($row = $result->fetch_assoc()) {
                //     echo $row['Transaction_Date'] . "<br>";
                //     echo $row['Transaction_Time'] . "<br>";
                // }
            }
            // add item to transaction (purchase relationship):
            $sql = "INSERT INTO PURCHASE (Item_UPC, Transaction_ID, 
            Customer_Phone_Number, Number_Bought, Price_Paid) 
            VALUES ('$upc', '$transaction_ID', '$customer_phone', $amount, $price)";

            if (mysqli_query($conn, $sql)) {
                // echo "Item added to purchase successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        ?>
        <h3> Current Items in Transaction <?=$transaction_ID?> for Customer 
        <?=$customer_phone?></h3>
        <?php
            $sql = "SELECT * FROM PURCHASE
            WHERE PURCHASE.Transaction_ID = '$transaction_ID' AND 
            PURCHASE.Customer_Phone_Number = '$customer_phone'";
            $response = $conn->query($sql);
            // echo $sql;
        ?>
            <table class="fl-table">
                <!-- <table border = '2'> -->
                <caption>Items in Transaction <?=$twodays_format?> </caption>
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
                        echo "<td>" . $row['Price_Paid'] . "</td>";
                        echo "</tr>";
                        }
                    } else {
                        echo "<tr>";
                        echo "<td>" . "0 items in transaction";
                        echo "</tr>";
                    }
                ?>
            </table>
    </div>
</body>
</html>
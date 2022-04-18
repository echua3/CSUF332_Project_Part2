<!--  Buy item(30points)
○ Should take an item id,customer id,and transaction id and add the item to the transaction.
○ If no transaction id is given then a new transaction is started for the customer.
-->
<!DOCTYPE html>
<html>


<div class="menu">
    <?php include 'menu.php';?>
</div>

<h3>Add Item to Transaction</h3>

<body>
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

    // echo $sql_p . "<br>";
    // echo $result->num_rows . "<br>";

    // get item price info    
    while($row = $result->fetch_assoc()) {
        $price = $row['Price'];
        $interim_price = $row['Interim_Price'];
        $wholesale_price = $row['Wholesale_Price'];
    }
    echo $price . "<br>";
    echo $interim_price . "<br>";
    echo $wholesale_price . "<br>";

    // set transaction price
    if (strcmp($itemprice, "price") == 0) {
        // $price = $price;
    } else if (strcmp($itemprice, "interim_price") == 0) {
        $price = $interim_price;
    } else {
        $price = $wholesale_price;
    }

    echo $price . "<br>";
    echo $customer_phone . "<br>";
    echo $transaction_ID . "<br>";

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
        echo $num_transactions . "<br>";
        echo sprintf('%02d', $num_transactions + 1) . "<br>";
        $transaction_ID = "TRANS" . sprintf('%02d', $num_transactions + 1);
        echo $transaction_ID;
        $transaction_date = date("Ymd");
        $transaction_time = date("H:i:s");
    
        $sql = "INSERT INTO TRANSACTION
        VALUES ('$transaction_ID','$customer_phone', '$transaction_date', '$transaction_time')";
    
        if (mysqli_query($conn, $sql)) {
            // echo "New transaction created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    
        // query to get all customer transactions
        $sql = "SELECT * FROM TRANSACTION
        WHERE TRANSACTION.Customer_Phone_Number = $customer_phone";
        $result = $conn->query($sql);
    
        while($row = $result->fetch_assoc()) {
            echo $row['Transaction_Date'] . "<br>";
            echo $row['Transaction_Time'] . "<br>";
        }
    }

    // add item to purchase:

    // while($row = $all_transactions->fetch_assoc()) {
    // echo "<tr>";
    // echo "<td style='padding: 3px'>" . $row['ID'] . "</td>";
    // echo "<td style='padding: 3px'>" . $row['Customer_Phone_Number'] . "</td>";
    // echo "</tr>";
    // }

    // if ($_POST['price'] = "Price"){
    //     $price = (float)$item['Price'];
    // } else if ($_POST['price'] = "interim_price")) {
    //     $price = (float)$item['Interim_Price'];
    // } else {
    //     $price = (float)$item['Wholesale_Price'];
    // }

    // if ($_POST['transaction_ID'] = "New") {
    //     $transaction = "TRANSNEW";
    // } else {
    //     $transaction = "$_POST['transaction_ID']";
    // }
    // $transaction_date = date("Ymd");
    // $transaction_time = date("H:i:s");


    // $sql = "INSERT INTO ITEM (UPC, Restock_Amount, Price, Interim_Price, 
    // Wholesale_Price, Current_Stock, Department_Name, Supplier_ID) 
    // VALUES ('" . $upc . "', " . $restock_amount . ", " . $price . ", " . $interim_price 
    // . ", " . $wholesale_price . ", " . $current_stock . ", '$department_name','$supplier_id')";

    // if (mysqli_query($conn, $sql)) {
    //     echo "New item created successfully";
    // } else {
    //     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    // }
?>
<h3> Current Items in Inventory </h3>
<?php
    // $query = "SELECT UPC FROM ITEM";
    // $response = @mysqli_query($conn, $query);
    // if($response){
    //     while($row = mysqli_fetch_array($response)){
    //         echo $row['UPC'] . ' ' . $row['ITEM']."<br>";
    //     }
    // }
?>
</body>
</html>
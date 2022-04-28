<!-- Apply Coupons to Transactions (25 points)
Takes Customer ID and transaction id
If the customer has coupons downloaded the coupons will be applied so only the
modified item price shows up on the transaction assuming the condition of the
individual coupons were met. 
print transaction
print customer's downloaded coupons
-->

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="/~cs332u7/table.css">
        <title>Apply Coupon</title>
    </head>

    <div class="menu">
        <?php include 'menu.php';?>
    </div>

    <h1>Apply Coupons to Transaction</h1>
    <div class="table-wrapper">
        <body>
            <!-- print original transaction table -->
            <?php
                require_once('connect.php');
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
            
            <!-- prints coupons downloaded by customer table -->
            <?php
                require_once('connect.php');
                $new_total_price = 0;
                $sql = "SELECT D.Coupon_ID, C.*
                FROM DOWNLOADS AS D, COUPON AS C
                WHERE D.Customer_Phone_Number = '$customer_phone'
                AND C.ID = D.Coupon_ID";
                $response = $conn->query($sql);
                // echo $sql;
            ?>
            <table class="fl-table">
                <caption>Customer <?=$_POST['customer_phone_number']?>
                Downloaded Coupons</caption>
                <thead>
                    <tr>
                        <th>Coupon ID</th>
                        <th>Item</th>
                        <th>Discount Amount</th>
                        <th>Minimum Number of Items</th>
                    </tr>
                </thead>
                <?php
                    if ($response->num_rows > 0) {
                        // output data of each row
                        while($row = $response->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['Coupon_ID'] . "</td>";
                            echo "<td>" . $row['Item_UPC'] . "</td>";
                            echo "<td>$" . $row['Discount_Amount'] . "</td>";
                            echo "<td>" . $row['Required_Item_Amount'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr>";
                        echo "<td>" . "0 Coupons Downloaded";
                        echo "</tr>";
                    }
                ?>
            </table>

            <!-- apply coupons to transactions 
                sql coupons and purchase transaction by phone number & 
                transactionID, every row = coupon.id, purchase.item_upc
                update the price paid by coupon discount amount if number
                bought is greater than or equal to required number bought -->
            <?php
                require_once('connect.php');
                // $sql = 
                // "UPDATE PURCHASE
                // SET PURCHASE.Price_Paid = PURCHASE.Price_Paid - COUPON.Discount_Amount
                // FROM 
                // ( SELECT * 
                //     FROM (( DOWNLOADS
                //             INNER JOIN PURCHASE ON PURCHASE.Customer_Phone_Number = DOWNLOADS.Customer_Phone_Number) 
                //             INNER JOIN COUPON ON DOWNLOADS.COUPON_ID = COUPON.ID)
                //         WHERE PURCHASE.Customer_Phone_Number = '$customer_phone' AND
                //         PURCHASE.transaction_ID = '$transaction_ID'
                // )
                // WHERE COUPON.Required_Item_Amount <= PURCHASE.Number_Bought";
                // echo $sql . "<br>";
                // $sql = "UPDATE PURCHASE
                // SET Price_Paid = PURCHASE.Price_Paid - COUPON.Discount_Amount
                // FROM 
                //     SELECT * 
                //     FROM    PURCHASE
                //             INNER JOIN DOWNLOADS ON PURCHASE.Customer_Phone_Number = DOWNLOADS.Customer_Phone_Number 
                //             INNER JOIN COUPON ON DOWNLOADS.COUPON_ID = COUPON.ID
                //     WHERE PURCHASE.Customer_Phone_Number = '$customer_phone' AND
                //     PURCHASE.transaction_ID = '$transaction_ID'
                // WHERE PURCHASE.Number_Bought >= COUPON.Required_Item_Amount";

                // $sql = "UPDATE PURCHASE 
                // SET Price_Paid = PURCHASE.Price_Paid - R.Discount_Amount 
                //     FROM    
                //         (   SELECT C.Required_Item_Amount, C.Discount_Amount, D.Customer_Phone_Number, C.Item_UPC
                //             FROM DOWNLOADS AS D
                //                 INNER JOIN COUPON AS C ON  
                //                 D.Coupon_ID = C.ID
                //             WHERE D.Customer_Phone_Number = '$customer_phone') AS R
                // WHERE PURCHASE.Number_Bought >= R.Required_Item_Amount 
                // AND PURCHASE.Customer_Phone_Number = R.Customer_Phone_Number
                // AND PURCHASE.Customer_Phone_Number = R.Item_UPC
                // AND PURCHASE.Transaction_ID = '$transaction_ID'";


                // $sql = "UPDATE PURCHASE 
                // SET Price_Paid = PURCHASE.Price_Paid - R2.Discount_Amount 
                // WHERE   Item_UPC IN 
                //         (   SELECT * 
                //             FROM COUPON AS C 
                //                 INNER JOIN (SELECT * FROM DOWNLOADS AS D 
                //                 WHERE D.Customer_Phone_Number = '$customer_phone') AS R
                //             ON C.ID = R.Coupon_ID) AS R2 
                // AND Number_Bought >= R2.Required_Item_Amount
                // AND Transaction_ID = '$transaction_ID'";

                // $sql = 
                //     "UPDATE PURCHASE
                //     INNER JOIN (SELECT * FROM COUPON INNER JOIN DOWNLOADS ON COUPON.ID = DOWNLOADS.Coupon_ID) AS R
                //             ON PURCHASE.Item_UPC = R.Item_UPC
                //     SET Price_Paid = Price_Paid - Discount_Amount 
                //     WHERE
                //         Customer_Phone_Number = '$customer_phone'
                //         AND Number_Bought >= Required_Item_Amount
                //         AND Transaction_ID = '$transaction_ID'";
                $sql = 
                "UPDATE PURCHASE P
                INNER JOIN COUPON C ON P.Item_UPC = C.Item_UPC
                INNER JOIN DOWNLOADS D ON C.ID = D.Coupon_ID
                SET P.Price_Paid = P.Price_Paid - C.Discount_Amount 
                WHERE
                    P.Customer_Phone_Number = '$customer_phone'
                    AND P.Number_Bought >= C.Required_Item_Amount
                    AND P.Transaction_ID = '$transaction_ID'";

                    // $sql = "SELECT * FROM COUPON AS C 
                    //     INNER JOIN (SELECT * FROM DOWNLOADS AS D 
                    //     WHERE D.Customer_Phone_Number = '$customer_phone') AS R
                    //     ON C.ID = R.Coupon_ID";
                



                echo $sql . "<br>";
                $response = $conn->query($sql);

                if ($response->num_rows > 0) {
                    // output data of each row
                    while($row = $response->fetch_assoc()) {
                        // echo "Coupon Applied <br>";
                        echo print_r($row) . "<br>";
                    }
                } else {
                    echo "0 Coupons <br>";
                }


                // $sql = "SELECT * FROM PURCHASE AS P, COUPON AS C, DOWNLOADS AS D
                // WHERE P.Transaction_ID = '$transaction_ID' AND 
                // P.Customer_Phone_Number = '$customer_phone' AND
                // D.Customer_Phone_Number = P.Customer_Phone_Number AND 
                // D.Coupon_ID = C.ID
                // ORDER BY C.Required_Item_Amount DESC";
                // $response = $conn->query($sql);
                // echo $sql . "<br>";
                // if ($response->num_rows > 0) {
                //     // output data of each row
                //     while($row = $response->fetch_assoc()) {
                //         $discount_amount = $row['Discount_Amount'];
                //         $item_UPC = $row['Item_UPC'];
                //         $old_price = $row['Price_Paid'];
                //         // check number of items bought 
                //         if ($row['Required_Item_Amount'] <= $row['Number_Bought']){
                //             $sql_update = "UPDATE PURCHASE 
                //                 SET Price_Paid = $old_price - $discount_amount
                //                 WHERE Item_UPC = $item_UPC AND 
                //                 Transaction_ID = $transaction_ID AND
                //                 Customer_Phone_Number = $customer_phone;"
                //                 if (mysqli_query($conn, $sql_update)) {
                //                     //echo "Query Successful" . "<br>";
                //                 } else {
                //                     echo "Error: " . $sql_update . "<br>" . mysqli_error($conn) 
                //                     . "<br>";
                //                 }  
                //         } else {
                //             echo "Requirement  NOT met <br>";
                //         }     
                //     }
                // } else {
                //     echo "0 Applicable Coupons" . "<br />";
                // }
            ?>

            <!-- prints updated transaction table -->
            <?php
                require_once('connect.php');
                $sql = "SELECT * FROM PURCHASE
                WHERE PURCHASE.Transaction_ID = '$transaction_ID' AND 
                PURCHASE.Customer_Phone_Number = '$customer_phone'";
                $response = $conn->query($sql);
                // echo $sql;
            ?>
            <table class="fl-table">
                <caption> Updated Transaction #<?=$_POST['transaction_ID']?> 
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
                            $new_total_price = $new_total_price + ($row['Price_Paid'] * $row['Number_Bought']);
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
                        echo "New Total Price: $" . $new_total_price;
                    ?>
                </strong>
            </p>
        </body>
    </div>
</html>
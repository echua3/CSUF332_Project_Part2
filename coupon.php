<!-- Apply Coupons to Transactions (25 points)
Takes Customer ID and transaction id
If the customer has coupons downloaded the coupons will be applied so only the
modified item price shows up on the transaction assuming the condition of the
individual coupons were met. -->
<!--
    print all coupons
    print customers and coupon downloads
    print all transactions
-->
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="/~cs332u7/table.css">
        <title>Coupons</title>
    </head>

    <div class="menu">
        <?php include 'menu.php';?>
    </div>

    <h1>Apply Coupon</h1>
    <div class="table-wrapper">
        <?php
            require_once('connect.php');

            $sql = "SELECT * FROM COUPON
            ORDER BY COUPON.Item_UPC";
            $all_coupons = $conn->query($sql);
        ?>
    
        <table class="fl-table">
            <caption>Coupons</caption>
            <thead>
                <tr>
                    <th>Coupon ID</th>
                    <th>Item</th>
                    <th>Discount Amount</th>
                    <th>Minimum Number of Items</th>
                </tr>
            </thead>
            <?php
                if ($all_coupons->num_rows > 0) {
                    // output data of each row
                    echo "<tbody>";
                    while($row = $all_coupons->fetch_assoc()) {   
                        echo "<tr>";
                        echo "<td>" . $row['ID'] . "</td>";
                        echo "<td>" . $row['Item_UPC'] . "</td>";
                        echo "<td>" . $row['Discount_Amount'] . "</td>";
                        echo "<td>" . $row['Required_Item_Amount'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                } else {
                    echo "0 Coupons";
                }
            ?>
        </table>

        <?php
            require_once('connect.php');

            $sql = "SELECT DOWNLOADS.Customer_Phone_Number, CUSTOMER.Name, 
            DOWNLOADS.Coupon_ID, COUPON.Item_UPC
            FROM DOWNLOADS, CUSTOMER, COUPON 
            WHERE DOWNLOADS.Customer_Phone_Number = CUSTOMER.Phone_Number
            AND DOWNLOADS.Coupon_ID = COUPON.ID
            ORDER BY CUSTOMER.Phone_Number";
            // echo $sql . "<br>";
            $all_downloads = $conn->query($sql);
        ?>
    
        <table class="fl-table">
            <caption>Customer Coupon Downloads</caption>
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Name</th>
                    <th>Coupon ID</th>
                    <th>Item</th>
                </tr>
            </thead>
            <?php
                if ($all_downloads->num_rows > 0) {
                    // output data of each row
                    echo "<tbody>";
                    while($row = $all_downloads->fetch_assoc()) {   
                        echo "<tr>";
                        echo "<td>" . $row['Customer_Phone_Number'] . "</td>";
                        echo "<td>" . $row['Name'] . "</td>";
                        echo "<td>" . $row['Coupon_ID'] . "</td>";
                        echo "<td>" . $row['Item_UPC'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                } else {
                    echo "0 Downloads";
                }
            ?>
        </table>
        <?php
            require_once('connect.php');

                $sql = "SELECT * FROM TRANSACTION
                ORDER BY TRANSACTION.Customer_Phone_Number, TRANSACTION.ID";
                $all_transactions = $conn->query($sql);
        ?>
        <table class="fl-table">
            <caption>Transactions</caption>
            <thead>
                <tr>
                    <th>Transaction</th>
                    <th>Customer Phone Number</th>
                </tr>
            </thead>

            <?php
                if ($all_transactions->num_rows > 0) {
                    // output data of each row
                    echo "<tbody>";
                    while($row = $all_transactions->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['ID'] . "</td>";
                    echo "<td>" . $row['Customer_Phone_Number'] . "</td>";
                    echo "</tr>";
                    }
                    echo "</tbody>";
                } else {
                    echo "0 items";
                }
            ?>
        </table>

        <h2>Apply Coupon to Transaction:</h2>
            <form action="coupon_submit.php" method="post">
                <div class="row">
                    <label>Customer Phone Number: </label>
                    <select name="Customer_Phone_Number">
                        <?php 
                            // use a while loop to fetch data 
                            $sql = "SELECT * FROM CUSTOMER";
                            $all_customers = $conn->query($sql);
                            while ($customer = mysqli_fetch_array($all_customers, MYSQLI_ASSOC)):; 
                        ?>
                            <option value="<?php echo $customer["Phone_Number"]; // primary key
                            ?>"
                            >
                            <?php echo $customer["Phone_Number"];
                                // To show the category name to the user
                            ?>
                        </option>
                        <?php 
                            endwhile; //terminate while loop
                        ?>
                    </select><br />
                </div>
                <div class="row">
                    <label>Transaction ID: </label>
                    <select name="transaction_ID">
                        <?php 
                            // use a while loop to fetch data 
                            $sql = "SELECT DISTINCT ID FROM TRANSACTION";
                            $all_transactions = $conn->query($sql);
                            while ($transaction = mysqli_fetch_array($all_transactions, MYSQLI_ASSOC)):; 
                        ?>
                            <option value="<?php echo $transaction["ID"]; // primary key
                            ?>"
                            >
                            <?php echo $transaction["ID"];
                                // To show the category name to the user
                            ?>
                        </option>
                        <?php 
                            endwhile; //terminate while loop
                        ?>
                    </select><br>
                </div>

                <div class="row">
                    <input type="submit">
                </div>
            </form>
    </div>
</html>
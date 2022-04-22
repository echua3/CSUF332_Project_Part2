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

        $sql = "SELECT * FROM ITEM";
        $all_items = $conn->query($sql);
    ?>

    <div class="table-wrapper">
        <?php
                $sql = "SELECT * FROM TRANSACTION
                ORDER BY TRANSACTION.Customer_Phone_Number, TRANSACTION.ID";
                $all_transactions = $conn->query($sql);
        ?>
        <table class="fl-table">
            <!-- <table border = '2' style="display: inline-block; border-collapse: collapse"> -->
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
        <br />
        <hr />
        <h2>Select Transaction:</h2>
        <form action="totaltransaction_submit.php" method="post">
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
            <label> Customer Phone Number: </label>
            <select name="customer_phone_number">
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
            </select><br>
            <input type="submit">
        </form>
    </div>
</body>

</html>
<!--  Buy item(30points)
○ Should take an item id,customer id,and transaction id and add the item to the transaction.
○ If no transaction id is given then a new transaction is started for the customer.
-->
<!DOCTYPE html>
<html>

<div class="menu">
    <?php include 'menu.php';?>
</div>
<h1>Add Item to Transaction</h1>

<body>
    <div>
<?php
    require_once('connect.php');

    $sql = "SELECT * FROM ITEM";
    $all_items = $conn->query($sql);
?>

<table border = '2' style="display: inline-block; border-collapse: collapse">
    <tr>
    <th style="padding: 10px">Item</th>
    <th style="padding: 10px">Stock</th>
</tr>

<?php
if ($all_items->num_rows > 0) {
    // output data of each row
    while($row = $all_items->fetch_assoc()) {
    echo "<tr>";
    echo "<td style='padding: 3px'>" . $row['UPC'] . "</td>";
    echo "<td style='padding: 3px'>" . $row['Current_Stock'] . "</td>";
    echo "</tr>";
    }
  } else {
    echo "0 items";
  }
?>
</table>

<?php
    $sql = "SELECT * FROM CUSTOMER";
    $all_customers = $conn->query($sql);
?>

<table border = '2' style="display: inline-block; border-collapse: collapse">
    <tr>
    <th style="padding: 10px">Customer</th>
    <th style="padding: 10px">Phone Number</th>
</tr>

<?php
if ($all_customers->num_rows > 0) {
    // output data of each row
    while($row = $all_customers->fetch_assoc()) {
    echo "<tr>";
    echo "<td style='padding: 3px'>" . $row['Name'] . "</td>";
    echo "<td style='padding: 3px'>" . $row['Phone_Number'] . "</td>";
    echo "</tr>";
    }
  } else {
    echo "0 items";
  }
?>
</table>

<?php
$sql = "SELECT * FROM TRANSACTION
ORDER BY TRANSACTION.Customer_Phone_Number";
$all_transactions = $conn->query($sql);
?>

<table border = '2' style="display: inline-block; border-collapse: collapse">
<tr>
<th style="padding: 10px">Transaction</th>
<th style="padding: 10px">Customer Phone Number</th>
</tr>

<?php
if ($all_transactions->num_rows > 0) {
    // output data of each row
    while($row = $all_transactions->fetch_assoc()) {
    echo "<tr>";
    echo "<td style='padding: 3px'>" . $row['ID'] . "</td>";
    echo "<td style='padding: 3px'>" . $row['Customer_Phone_Number'] . "</td>";
    echo "</tr>";
    }
  } else {
    echo "0 items";
  }
?>
</table>

</div>
<br />
<hr />
<div style="clear:both">
<h2>Add Item to Transaction:</h2>
<form action="buyitem_submit.php" method="post">
<label>Item:</label>
<select name="UPC" required>
    <?php 
        // use a while loop to fetch data 
        $sql = "SELECT * FROM ITEM";
        $all_items = $conn->query($sql);

        while ($item = mysqli_fetch_array($all_items, MYSQLI_ASSOC)):; 
    ?>
    <option value="<?php echo $item["UPC"]?>">
        <?php echo $item["UPC"];
            // To show the category name to the user
        ?>
    </option>
    <?php 
        endwhile; //terminate while loop
    ?>
</select><br>
<label>Amount: </label>
<input type="number" min = "1" name="amount"><br>
<label>Price: </label>
<select name="price">
    <option value ="price">Price</option>
    <option value ="interim_price">Interim</option>
    <option value ="wholesale_price">Wholesale</option>
</select><br>
<label> Customer Phone: </label>
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
<label>Transaction ID: </label>
<select name="transaction_ID">
    <option value="New">New</option>
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
<input type="submit">
</form>
</div>

</body>

</html>
<!DOCTYPE html>
<html>

<div class="menu">
    <?php include 'menu.php';?>
</div>
<h2> Add Item to Inventory</h2>

<body>
<?php
$servername = "mariadb";
$username = "cs332u7";
$password = "hnSfRXu6";
$dbname = "cs332u7";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT ID FROM SUPPLIER";
$result = $conn->query($sql);

echo "Supplier IDs: " . "<br>";

if ($result->num_rows > 0) {
    // output available Supplier IDs
    while($row = $result->fetch_assoc()) {
      echo $row["ID"]. "<br>";
    }
  } else {
    echo "0 results";
  }

$sql = "SELECT `Name` FROM DEPARTMENT";
$result = $conn->query($sql);

echo "<br>" . "Departments: " . "<br>";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo $row["Name"] . "<br>";
    }
  } else {
    echo "0 results";
  }

?>

<h3>Enter new item information:</h3>

<form action="insert_item_submit.php" method="post">
UPC: <input type="text" name="UPC"><br>
Restock Amount: <input type="text" name="restock_amount"><br>
Price: <input type="text" name="price"><br>
Interim Price: <input type="text" name="interim_price"><br>
Wholesale Price: <input type="text" name="wholesale_price"><br>
Current Stock: <input type="text" name="current_stock"><br>
Departnent Name: <input type="text" name="department_name"><br>
Supplier ID: <input type="text" name="supplier_id"><br>
<input type="submit">
</form>

</body>

</html>
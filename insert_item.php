<!DOCTYPE html>
<html>

<div class="menu">
    <?php include 'menu.php';?>
</div>
<h2> Add Item to Inventory</h2>

<body>
<?php
require_once('connect.php');

$sql = "SELECT * FROM ITEM";
$items = $conn->query($sql);

$sql1 = "SELECT ID FROM SUPPLIER";
$supplierIDs = $conn->query($sql1);

$sql2 = "SELECT * FROM DEPARTMENT";
$all_departments = $conn->query($sql2);

?>
<table border = '2'>
<tr>
<th>UPC</th>
<th>Price</th>
<th>Department</th>
<th>Supplier</th>
</tr>

<?php
if ($items->num_rows > 0) {
    // output data of each row
    while($row = $items->fetch_assoc()) {
    //   echo $row["UPC"] . " " . $row["Price"] . " " . $row["Department_Name"] . 
    //   " " . $row["Supplier_ID"] . "<br>";
    echo "<tr>";
    echo "<td>" . $row['UPC'] ."</td>";
    echo "<td>" . $row['Price'] . "</td>";
    echo "<td>" . $row['Department_Name'] . "</td>";
    echo "<td>" . $row['Supplier_ID'] . "</td>";
    echo "</tr>";
    }
  } else {
    echo "0 items";
  }
?>
</table>

<h3>Enter new item information:</h3>

<form action="insert_item_submit.php" method="post">
<label> UPC: </label>
<input type="text" name="UPC" required><br>
<label> Restock Amount: </label>
<input type="number" min = "0" name="restock_amount"><br>
<label> Price: </label>
<input type="number" min = "0" name="price"><br>
<label> Interim Price: </label>
<input type="number" min = "0" name="interim_price"><br>
<label> Wholesale Price: </label>
<input type="number" min = "0" name="wholesale_price"><br>
<label> Current Stock: </label>
<input type="number" min = "0" name="current_stock"><br>

<label> Departnent Name: </label>
<select name="department_name">
    <?php 
        // use a while loop to fetch data 
        while ($department = mysqli_fetch_array($all_departments, MYSQLI_ASSOC)):; 
    ?>
        <option value="<?php echo $department["Name"]; // primary key
        ?>"
        >
        <?php echo $department["Name"];
            // To show the category name to the user
        ?>
    </option>
    <?php 
        endwhile; //terminate while loop
    ?>
</select><br>

<label> Supplier ID:</label>
<select name="supplier_id">
    <?php 
        // use a while loop to fetch data 
        while ($id = mysqli_fetch_array($supplierIDs, MYSQLI_ASSOC)):; 
    ?>
        <option value="<?php echo $id["ID"]; // primary key
        ?>"
        >
        <?php echo $id["ID"];
            // To show the category name to the user
        ?>
    </option>
    <?php 
        endwhile; //terminate while loop
    ?>
</select><br>

<input type="submit">
</form>

</body>

</html>
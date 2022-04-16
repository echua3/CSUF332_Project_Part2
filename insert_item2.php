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

$sql1 = "SELECT ID FROM SUPPLIER";
$supplierIDs = $conn->query($sql1);

$sql2 = "SELECT * FROM DEPARTMENT";
$all_departments = $conn->query($sql2);

?>

<h3>Enter new item information:</h3>

<form action="insert_item_submit.php" method="post">
<label> UPC: </label>
<input type="text" name="UPC" required><br>
<label> Restock Amount: </label>
<input type="text" name="restock_amount"><br>
<label> Price: </label>
<input type="text" name="price"><br>
<label> Interim Price: </label>
<input type="text" name="interim_price"><br>
<label> Wholesale Price: </label>
<input type="text" name="wholesale_price"><br>
<label> Current Stock: </label>
<input type="text" name="current_stock"><br>

<label> Departnent Name: </label>
<select name="department_name">
    <?php 
        // use a while loop to fetch data 
        while ($department = mysqli_fetch_array($all_departments, MYSQLI_ASSOC)):; 
    ?>
        <option value="
        <?php echo $department["Name"]; // primary key
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
        <option value="
        <?php echo $id["ID"]; // primary key
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
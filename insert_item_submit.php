<!DOCTYPE html>
<html>


<div class="menu">
    <?php include 'menu.php';?>
</div>

<h3> Adding Item to Inventory </h3>

<body>
<?php
    require_once('connect.php');

    echo "UPC: " . $_POST['UPC'] . "<br>";
    echo "Restock Amount: " . $_POST['restock_amount'] . "<br>";
    echo "Price: " . $_POST['price'] . "<br>";
    echo "Interim Price: " . $_POST['interim_price'] . "<br>"; 
    echo "Wholesale Price: " . $_POST['wholesale_price'] . "<br>";
    echo "Current Stock: " . $_POST['current_stock'] . "<br>";
    echo "Department Name: " . $_POST['department_name'] . "<br>"; 
    echo "Supplier ID: " . $_POST['supplier_id'] . "<br>";
    echo "<br>";

    $upc = (string)$_POST['UPC'];
    $restock_amount = (int)$_POST['restock_amount'];
    $price = (float)$_POST['price'];
    $interim_price = (float)$_POST['interim_price'];
    $wholesale_price = (float)$_POST['wholesale_price'];
    $current_stock = (int)$_POST['current_stock'];
    $department_name = $_POST['department_name'];
    // $department_name = mysqli_real_escape_string($conn,$_POST['department_name']);
    $supplier_id = $_POST['supplier_id'];
    // $supplier_id = mysqli_real_escape_string($conn,$_POST['supplier_id']);

    $sql = "INSERT INTO ITEM (UPC, Restock_Amount, Price, Interim_Price, 
    Wholesale_Price, Current_Stock, Department_Name, Supplier_ID) 
    VALUES ('" . $upc . "', " . $restock_amount . ", " . $price . ", " . $interim_price 
    . ", " . $wholesale_price . ", " . $current_stock . ", '$department_name','$supplier_id')";

    if (mysqli_query($conn, $sql)) {
        echo "New item created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
?>
<h3> Current Items in Inventory </h3>
<?php
    $query = "SELECT UPC FROM ITEM";
    $response = @mysqli_query($conn, $query);
    if($response){
        while($row = mysqli_fetch_array($response)){
            echo $row['UPC'] . ' ' . $row['ITEM']."<br>";
        }
    }
?>
</body>
</html>
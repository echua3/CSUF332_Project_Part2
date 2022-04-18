<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="/~cs332u7/table.css">
<title>Add Item</title>
</head>

<div class="menu">
    <?php include 'menu.php';?>
</div>

<h1>Adding Item to Inventory</h1>

<body>
<div class="table-wrapper">
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
    $supplier_id = $_POST['supplier_id'];

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
<h2> Current Items in Inventory </h2>

    <table class="fl-table">
<!-- <table border = '2' style="border-collapse: collapse"> -->
<thead>
<tr>
<th>UPC</th>
<th>Price</th>
<th>Department</th>
<th>Supplier</th>
<th>Restock Amount</th>
<th>Current Stock</th>
</tr>
</thead>

<?php
    $sql = "SELECT * FROM ITEM";
    $items = $conn->query($sql);
    if ($items->num_rows > 0) {
        // output data of each row
        while($row = $items->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['UPC'] ."</td>";
        echo "<td>" . $row['Price'] . "</td>";
        echo "<td>" . $row['Department_Name'] . "</td>";
        echo "<td>" . $row['Supplier_ID'] . "</td>";
        echo "<td>" . $row['Restock_Amount'] . "</td>";
        echo "<td>" . $row['Current_Stock'] . "</td>";
        echo "</tr>";
        }
    } else {
        echo "0 items";
    }
?>
</table>
<?php
    // $query = "SELECT UPC FROM ITEM";
    // $response = @mysqli_query($conn, $query);
    // if($response){
    //     while($row = mysqli_fetch_array($response)){
    //         echo $row['UPC'] . ' ' . $row['ITEM']."<br>";
    //     }
    // }
?>
</div>
</body>

</html>
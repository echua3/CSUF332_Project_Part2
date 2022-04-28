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
            <div style="text-align: center">
                <?php
                    require_once('connect.php');

                    echo "<b>UPC:</b> " . $_POST['UPC'] . "<br>";
                    echo "<b>Restock Amount:</b> " . $_POST['restock_amount'] . "<br>";
                    echo "<b>Price:</b> " . $_POST['price'] . "<br>";
                    echo "<b>Interim Price:</b> " . $_POST['interim_price'] . "<br>"; 
                    echo "<b>Wholesale Price:</b> " . $_POST['wholesale_price'] . "<br>";
                    echo "<b>Current Stock:</b> " . $_POST['current_stock'] . "<br>";
                    echo "<b>Department Name:</b> " . $_POST['department_name'] . "<br>"; 
                    echo "<b>Supplier ID:</b> " . $_POST['supplier_id'] . "<br>";
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
                        echo "<b>New item created successfully</b>";
                    } else {
                        echo "<b>Item not added</b> <br>";
                        echo "Error: " . mysqli_error($conn);
                        // echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                ?>
            </div>
            <table class="fl-table">
                <caption>Current Items in Inventory</caption>
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
        </div>
    </body>
</html>
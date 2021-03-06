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

                    $upc = (string)$_POST['UPC'];
                    $restock_amount = (int)$_POST['restock_amount'];
                    $price = (float)$_POST['price'];
                    $interim_price = (float)$_POST['interim_price'];
                    $wholesale_price = (float)$_POST['wholesale_price'];
                    $current_stock = (int)$_POST['current_stock'];
                    $department_name = $_POST['department_name'];
                    $supplier_id = $_POST['supplier_id'];
                    $expiration_date = $_POST['expiration_date'];
                    $aisle_number = $_POST['aisle_number'];
                    $aisle_side = $_POST['aisle_side'];
                    $section_number = $_POST['section_number'];
                    $shelf_number = $_POST['shelf_number'];
                    $number_of_items_down = $_POST['number_of_items_down'];

                    echo "<b>UPC:</b> $upc<br>";
                    echo "<b>Restock Amount:</b> $restock_amount<br>";
                    echo "<b>Price:</b> $price<br>";
                    echo "<b>Interim Price:</b> $interim_price<br>"; 
                    echo "<b>Wholesale Price:</b> $wholesale_price<br>";
                    echo "<b>Current Stock:</b> $current_stock<br>";
                    echo "<b>Department Name:</b> $department_name<br>"; 
                    echo "<b>Supplier ID:</b> $supplier_id<br>";
                    echo "<b>Expiration Date:</b> $expiration_date<br>";
                    echo "<b>Aisle Number:</b> $aisle_number<br>";
                    echo "<b>Aisle Side:</b> $aisle_side<br>";
                    echo "<b>Section Number:</b> $section_number<br>";
                    echo "<b>Shelf Number:</b> $shelf_number<br>";
                    echo "<b>Number of Items down:</b> $number_of_items_down<br>";
                    echo "<br>";
        
                    $sql = "INSERT INTO ITEM (UPC, Restock_Amount, Price, Interim_Price, 
                    Wholesale_Price, Current_Stock, Department_Name, Supplier_ID) 
                    VALUES ('" . $upc . "', " . $restock_amount . ", " . $price . ", " . $interim_price 
                    . ", " . $wholesale_price . ", " . $current_stock . ", '$department_name','$supplier_id')";

                    if (mysqli_query($conn, $sql)) {
                        echo "<b>New item created successfully</b><br>";
                    } else {
                        echo "<b>Item not added</b> <br>";
                        echo "Error: " . mysqli_error($conn). "<br>";
                        // echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }

                    // add expiration date
                    if (!empty($_POST['expiration_date'])) {
                        $sql = "INSERT INTO EXPIRATION (Item_UPC, Expiration_Date) 
                        VALUES ('$upc', '$expiration_date')";

                        if (mysqli_query($conn, $sql)) {
                            echo "<b>Expiration added</b><br>";
                        } else {
                            echo "<b>Expiration date not added</b> <br>";
                            echo "Error: " . mysqli_error($conn);
                        }
                    } 

                    // add location
                    $sql = "INSERT INTO LOCATION (Aisle_Number, Aisle_Side, 
                    Section_Number, Shelf_Number, Number_of_Items_Down, Item_UPC)
                    VALUES ($aisle_number, '$aisle_side', $section_number,
                    $shelf_number, $number_of_items_down, '$upc')";

                    if (mysqli_query($conn, $sql)) {
                        echo "<b>Item Location Added</b><br>";
                    } else {
                        echo "<b>Item Location not added</b> <br>";
                        echo "Error: " . mysqli_error($conn). "<br>";
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
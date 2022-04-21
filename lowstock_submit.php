<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/~cs332u7/table.css">
    <title>Low Stock Items</title>
</head>


<div class="menu">
    <?php include 'menu.php';?>
</div>

<h1>The <?= $_POST['department_name']?> Department's Low Stock Items</h1>
    <body>
    <?php
        require_once('connect.php');

        $department_name = $_POST['department_name'];

        $sql = "SELECT *
        FROM ITEM
        WHERE ITEM.Department_Name = '$department_name' 
        and ITEM.Current_Stock <= ITEM.Restock_Amount";
        $items = $conn->query($sql);

        if (mysqli_query($conn, $sql)) {
            //echo "Query Successful" . "<br>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    ?>
    <div class="table-wrapper">
        <div style=“padding-bottom: 40px”>
            <table class="fl-table">
                <!-- <table border = '2'> -->
                <caption>Items in Low Stock</caption>
                <thead> 
                    <tr>
                    <th>UPC</th>
                    <th>Current Stock</th>
                    <th>Restock Amount</th>
                    <th>Supplier</th>
                    </tr>
                </thead>
            <?php
                if ($items->num_rows > 0) {
                    // output data of each row
                    while($row = $items->fetch_assoc()) {
                    //    echo $row["UPC"] . " " . $row["Current_Stock"] . " " . $row["Department_Name"] . 
                    //    " " . $row["Supplier_ID"] . " " .$row["Expiration_Date"] . "<br>";
                    echo "<tr>";
                    echo "<td>" . $row['UPC'] . "</td>";
                    echo "<td>" . $row['Current_Stock'] . "</td>";
                    echo "<td>" . $row['Restock_Amount'] . "</td>";
                    echo "<td>" . $row['Supplier_ID'] . "</td>";
                    echo "</tr>";
                    }
                } else {
                    echo "<tr>";
                    echo "<td>" . "0 items in low stock";
                    echo "</tr>";
                }
            ?>
            </table>
        </div>

    <?php
        $sql = "SELECT *
        FROM ITEM, `ORDER`
        WHERE ITEM.Department_Name = '$department_name' 
        and ITEM.Current_Stock <= ITEM.Restock_Amount
        and ITEM.UPC = `ORDER`.Item_UPC";
        $items = $conn->query($sql);

        if (mysqli_query($conn, $sql)) {
            //echo "Query Successful" . "<br>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    ?>

    <br>
        <table class="fl-table">
            <!-- <table border = '2'> -->
            <caption>Orders</caption>
            <thead> 
                <tr>
                <th>Order Date</th>
                <th>Item</th>
                <th>Amount</th>
                <th>Delivery Status</th>
                </tr>
            </thead>

            <?php
                if ($items->num_rows > 0) {
                    // output data of each row
                    while($row = $items->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['Order_Date'] . "</td>";
                    echo "<td>" . $row['UPC'] . "</td>";
                    echo "<td>" . $row['Amount_of_Item'] . "</td>";
                    echo "<td>" . $row['Delivery_Status'] . "</td>";
                    echo "</tr>";
                    }
                } else {
                    echo "<tr>";
                    echo "<td>" . "0 orders";
                    echo "</tr>";
                }
            ?>
        </table>

    </div>
    </body>
</html>
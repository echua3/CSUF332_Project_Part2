<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/~cs332u7/table.css">
    <title>Add Item</title>
</head>

<div class="menu">
    <?php include 'menu.php';?>
</div>
<h1>Add Item to Inventory</h1>
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
    <div class="table-wrapper">
        <table class="fl-table">
        <!-- <table border = '2' style="border-collapse: collapse"> -->
            <thead>
                <tr>
                    <th>UPC</th>
                    <th>Price</th>
                    <th>Department</th>
                    <th>Supplier</th>
                </tr>
            </thead>
            <?php
            if ($items->num_rows > 0) {
                // output data of each row
                while($row = $items->fetch_assoc()) {
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
        <br />
        <hr />
        <h2>Enter new item information:</h2>

        <form action="insert_item_submit.php" method="post">
            <div class="row">   
                <label> UPC: </label>
                <input type="text" name="UPC" required><br>
            </div>
            <div class="row">
                <label> Restock Amount: </label>
                <input type="number" min = "0" name="restock_amount"><br>
            </div>
            <div class="row">
                <label> Price: </label>
                <input type="number" step="0.01" min = "0" name="price"><br>
            </div>
            <div class="row">
                <label> Interim Price: </label>
                <input type="number" step="0.01" min = "0" name="interim_price"><br>
            </div>
            <div class="row">
                <label> Wholesale Price: </label>
                <input type="number" step="0.01" min = "0" name="wholesale_price"><br>
            </div>
            <div class="row">
                <label> Current Stock: </label>
                <input type="number" min = "0" name="current_stock"><br>
            </div>
            <div class="row">
                <label> Department Name: </label>
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
            </div>
            <div class="row">
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
            </div>
            <input type="submit">
        </form>
    </div>
</body>
</html>
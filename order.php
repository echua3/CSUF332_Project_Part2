<!-- Place order by an employee (25 points)
Should take an employee id, item id, and amount of the item to order
If the employee’s permission level is 0 return a message saying they do not have permission and reject the order
If the employee does have permission then add the order to the database with the order not having been added to a delivery yet -->
<!-- PRINTS EMPLOYEE LIST
PRINTS ITEM LIST
ASKS FOR INFO -->
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="/~cs332u7/table.css">
        <title>Employee Order</title>
    </head>

    <div class="menu">
        <?php include 'menu.php';?>
    </div>
    <h1>Order Form</h1>

    <div class="table-wrapper">
        <?php
            require_once('connect.php');

            $sql = "SELECT * FROM EMPLOYEE
            ORDER BY EMPLOYEE.Last_Name";
            $all_items = $conn->query($sql);
        ?>
    
        <table class="fl-table">
            <caption>Employees</caption>
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Permission Level</th>
                    <th>Department</th>
                </tr>
            </thead>
            <?php
                if ($all_items->num_rows > 0) {
                    // output data of each row
                    echo "<tbody>";
                    while($row = $all_items->fetch_assoc()) {   
                        echo "<tr>";
                        echo "<td>" . $row['ID'] . "</td>";
                        echo "<td>" . $row['Last_Name'] . "</td>";
                        echo "<td>" . $row['First_Name'] . "</td>";
                        echo "<td>" . $row['Permission_Level'] . "</td>";
                        echo "<td>" . $row['Department_Name'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                } else {
                    echo "0 items";
                }
            ?>
        </table>
        <?php
            require_once('connect.php');

            $sql = "SELECT * FROM ITEM";
            $all_items = $conn->query($sql);
        ?>
        <table class="fl-table">
            <caption>Items</caption>
            <thead>
                <tr>
                    <th>Item UPC</th>
                    <th>Current Stock</th>
                    <th>Restock Amount</th>
                    <th>Price</th>
                    <th>Interim Price</th>
                    <th>Wholesale Price</th>
                    <th>Department</th>
                    <th>Supplier ID</th>
                </tr>
            </thead>
            <?php
                if ($all_items->num_rows > 0) {
                    // output data of each row
                    echo "<tbody>";
                    while($row = $all_items->fetch_assoc()) {   
                        echo "<tr>";
                        echo "<td>" . $row['UPC'] . "</td>";
                        echo "<td>" . $row['Current_Stock'] . "</td>";
                        echo "<td>" . $row['Restock_Amount'] . "</td>";
                        echo "<td>" . $row['Price'] . "</td>";
                        echo "<td>" . $row['Interim_Price'] . "</td>";
                        echo "<td>" . $row['Wholesale_Price'] . "</td>";
                        echo "<td>" . $row['Department_Name'] . "</td>";
                        echo "<td>" . $row['Supplier_ID'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                } else {
                    echo "0 items";
                }
            ?>
        </table>
        <h2>Order:</h2>
            <form action="order_submit.php" method="post">
                <div class="row">
                    <label>Employee ID: </label>
                    <select name="Employee_ID">
                        <?php 
                            // use a while loop to fetch data 
                            $sql = "SELECT ID FROM EMPLOYEE";
                            $all_employees = $conn->query($sql);
                            while ($employee = mysqli_fetch_array($all_employees, MYSQLI_ASSOC)):; 
                        ?>
                            <option value="<?php echo $employee["ID"]; // primary key
                            ?>"
                            >
                            <?php echo $employee["ID"];
                                // To show the category name to the user
                            ?>
                        </option>
                        <?php 
                            endwhile; //terminate while loop
                        ?>
                    </select><br />
                </div>
                <div class="row">
                    <label>Item: </label>
                    <select name="Item_UPC">
                        <?php 
                            // use a while loop to fetch data 
                            $sql = "SELECT * FROM ITEM";
                            $all_items = $conn->query($sql);
                            while ($item = mysqli_fetch_array($all_items, MYSQLI_ASSOC)):; 
                        ?>
                            <option value="<?php echo $item["UPC"]; // primary key
                            ?>"
                            >
                            <?php echo $item["UPC"];
                                // To show the category name to the user
                            ?>
                        </option>
                        <?php 
                            endwhile; //terminate while loop
                        ?>
                    </select><br />
                </div>
                <div class="row">
                    <label>Amount: </label>
                    <input type="number" min = "1" name="amount" required>
                </div>
                <input type="submit">
            </form>
    </div>
</html>
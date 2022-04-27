<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/~cs332u7/table.css">
    <title>Low Stock Items</title>
</head>

<div class="menu">
    <?php include 'menu.php';?>
</div>
<h1>Items with Low Stock</h1>

<body>
    <?php
        require_once('connect.php');

        $sql = "SELECT * FROM DEPARTMENT";
        $all_departments = $conn->query($sql);
    ?>
    <div class="table-wrapper">
        <table class="fl-table">
            <!-- <table border = '2' style="border-collapse: collapse"> -->
            <thead>
                <tr>
                    <th>Department</th>
                    <th>Section</th>
                </tr>
            </thead>
            <?php
                if ($all_departments->num_rows > 0) {
                    // output data of each row
                    while($row = $all_departments->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['Name'] . "</td>";
                    echo "<td>" . $row['Section'] . "</td>";
                    echo "</tr>";
                    }
                } else {
                    echo "0 items";
                }
            ?>
        </table>
        <br />
        <hr />
        <h2>Select Department:</h2>
        <form action="lowstock_submit.php" method="post">
            <div class="row">
                <select name="department_name">
                    <?php 
                        // use a while loop to fetch data 
                        $sql = "SELECT * FROM DEPARTMENT";
                        $all_departments = $conn->query($sql);

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
                </select>
                <input type="submit">
            </div>
        </form>
    </div>
</body>
</html>
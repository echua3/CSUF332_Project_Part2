<!DOCTYPE html>
<html>

<div class="menu">
    <?php include 'menu.php';?>
</div>
<h2>Items with Low Stock</h2>

<body>
<?php
require_once('connect.php');

$sql = "SELECT * FROM DEPARTMENT";
$all_departments = $conn->query($sql);
?>

<table border = '2' style="border-collapse: collapse">
<tr>
<th style="padding: 10px">Department</th>
<th style="padding: 10px">Section</th>
</tr>

<?php
if ($all_departments->num_rows > 0) {
    // output data of each row
    while($row = $all_departments->fetch_assoc()) {
    echo "<tr>";
    echo "<td style='padding: 3px'>" . $row['Name'] . "</td>";
    echo "<td style='padding: 3px'>" . $row['Section'] . "</td>";
    echo "</tr>";
    }
  } else {
    echo "0 items";
  }
?>
</table>

<h3>Select Department:</h3>
<form action="lowstock_submit.php" method="post">
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
</form>

</body>

</html>
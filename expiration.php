<!DOCTYPE html>
<html>

<div class="menu">
    <?php include 'menu.php';?>
</div>
<h2> Items Expiring</h2>

<body>
<?php
require_once('connect.php');

$sql = "SELECT * FROM DEPARTMENT";
$all_departments = $conn->query($sql);
?>

<table border = '2'>
<tr>
<th>Department</th>
<th>Section</th>
</tr>

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

<h3>Seclect Department:</h3>
<form action="expiration_submit.php" method="post">
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
</select><br>
<input type="submit">
</form>

</body>

</html>

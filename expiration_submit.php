<!DOCTYPE html>
<html>


<div class="menu">
    <?php include 'menu.php';?>
</div>

<h3> Items Expiring Soon in the <?= $_POST['department_name'] ?> Department</h3>

<body>
<?php
    require_once('connect.php');

    // echo "Department Name: " . $_POST['department_name'] . "<br>"; 

    $department_name = $_POST['department_name'];
    $twodays = date("Y-m-d", mktime(0, 0, 0, date("m")  , date("d")+2, date("Y"))); 
    $twodays_format = date("F j, Y", mktime(0, 0, 0, date("m")  , date("d")+2, date("Y"))); 
    // echo "Lists items expiring on or before " . $twodays_format;

    $sql = "SELECT *
    FROM ITEM, EXPIRATION
    WHERE ITEM.Department_Name = '$department_name' and ITEM.UPC = EXPIRATION.Item_UPC
    and EXPIRATION.Expiration_date <= '$twodays'";
    $items = $conn->query($sql);

    if (mysqli_query($conn, $sql)) {
        //echo "Query Successful" . "<br>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
?>
<table border = '2'>
<caption>Lists items expiring on or before <?=$twodays_format?> </caption>
<tr>
<th>UPC</th>
<th>Current_Stock</th>
<th>Restock_Amount</th>
<th>Supplier_ID</th>
<th>Expiration_Date</th>
</tr>

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
           echo "<td>" . $row['Expiration_Date'] . "</td>";
           echo "</tr>";
        }
      } else {
        echo "<tr>";
        echo "<td>" . "0 items expiring";
        echo "</tr>";
      }
?>


</body>
</html>
<!-- Has all table information -->
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="/~cs332u7/table.css">
        <title>All information</title>
    </head>

    <div class="menu">
        <?php include 'menu.php';?>
    </div>
    <div class="table-wrapper">
        <a href="#items">Items</a> 
        <a href="#suppliers">Suppliers</a> 
        <a href="#departments">Departments</a> 
        <a href="#employees">Employees</a> 
        <a href="#supervises">Supervisors</a> 
        <a href="#locations">Locations</a> 
        <a href="#expiration">Expiration</a> 
        <a href="#deliveries">Deliveries</a> 
        <a href="#orders">Orders</a> 
        <a href="#customers">Customers</a> 
        <a href="#transaction">Transactions</a> 
        <a href="#purchases">Purchases</a> 
        <a href="#coupons">Coupons</a> 
        <a href="#bought">Bought</a> 
        <a href="#downloads">Downloads</a>   

        <a id="items"><h1>Items</h1></a>
        <?php
            require_once('connect.php');

            $sql = "SELECT * FROM ITEM";
            $all_items = $conn->query($sql);
        ?>
    
        <table class="fl-table">
            <!-- <table border = '2' style="display: inline-block; border-collapse: collapse"> -->
            <thead>
                <tr>
                    <th>Item UPC</th>
                    <th>Current Stock</th>
                    <th>Restock Amount</th>
                    <th>Price</th>
                    <th>Interim Price</th>
                    <th>Wholesale Price</th>
                    <th>Department Name</th>
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
        <a id="suppliers"><h1>Suppliers</h1></a>
        <?php
            require_once('connect.php');

            $sql = "SELECT * FROM SUPPLIER";
            $all_items = $conn->query($sql);
        ?>
    
        <table class="fl-table">
            <!-- <table border = '2' style="display: inline-block; border-collapse: collapse"> -->
            <thead>
                <tr>
                    <th>Supplier ID</th>
                    <th>Representative</th>
                    <th>Phone Number</th>
                </tr>
            </thead>
            <?php
                if ($all_items->num_rows > 0) {
                    // output data of each row
                    echo "<tbody>";
                    while($row = $all_items->fetch_assoc()) {   
                        echo "<tr>";
                        echo "<td>" . $row['ID'] . "</td>";
                        echo "<td>" . $row['Representative'] . "</td>";
                        echo "<td>" . $row['Phone_Number'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                } else {
                    echo "0 items";
                }
            ?>
        </table>
        <a id="departments"><h1>Departments</h1></a>
        <?php
            require_once('connect.php');

            $sql = "SELECT * FROM DEPARTMENT";
            $all_items = $conn->query($sql);
        ?>
    
        <table class="fl-table">
            <!-- <table border = '2' style="display: inline-block; border-collapse: collapse"> -->
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Section</th>
                </tr>
            </thead>
            <?php
                if ($all_items->num_rows > 0) {
                    // output data of each row
                    echo "<tbody>";
                    while($row = $all_items->fetch_assoc()) {   
                        echo "<tr>";
                        echo "<td>" . $row['Name'] . "</td>";
                        echo "<td>" . $row['Section'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                } else {
                    echo "0 items";
                }
            ?>
        </table>
        <a id="employees"><h1>Employees</h1></a>
        <?php
            require_once('connect.php');

            $sql = "SELECT * FROM EMPLOYEE
            ORDER BY EMPLOYEE.Last_Name";
            $all_items = $conn->query($sql);
        ?>
    
        <table class="fl-table">
            <!-- <table border = '2' style="display: inline-block; border-collapse: collapse"> -->
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Permission Level</th>
                    <th>Department Name</th>
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
        <a id="supervises"><h1>Supervises</h1></a>
        <?php
            require_once('connect.php');

            $sql = "SELECT * FROM SUPERVISES
            ORDER BY SUPERVISES.Department_Name";
            $all_items = $conn->query($sql);
        ?>
    
        <table class="fl-table">
            <!-- <table border = '2' style="display: inline-block; border-collapse: collapse"> -->
            <thead>
                <tr>
                    <th>Department Name</th>
                    <th>Employee ID</th>
                </tr>
            </thead>
            <?php
                if ($all_items->num_rows > 0) {
                    // output data of each row
                    echo "<tbody>";
                    while($row = $all_items->fetch_assoc()) {   
                        echo "<tr>";
                        echo "<td>" . $row['Department_Name'] . "</td>";
                        echo "<td>" . $row['Employee_ID'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                } else {
                    echo "0 items";
                }
            ?>
        </table>
        <a id="locations"><h1>Locations</h1></a>
        <?php
            require_once('connect.php');

            $sql = "SELECT * FROM LOCATION
            ORDER BY LOCATION.Aisle_Number";
            $all_items = $conn->query($sql);
        ?>
    
        <table class="fl-table">
            <!-- <table border = '2' style="display: inline-block; border-collapse: collapse"> -->
            <thead>
                <tr>
                    <th>Aisle Number</th>
                    <th>Aisle Side</th>
                    <th>Section Number</th>
                    <th>Shelf Number</th>
                    <th>Number of Items Down</th>
                    <th>Item UPC</th>
                </tr>
            </thead>
            <?php
                if ($all_items->num_rows > 0) {
                    // output data of each row
                    echo "<tbody>";
                    while($row = $all_items->fetch_assoc()) {   
                        echo "<tr>";
                        echo "<td>" . $row['Aisle_Number'] . "</td>";
                        echo "<td>" . $row['Aisle_Side'] . "</td>";
                        echo "<td>" . $row['Section_Number'] . "</td>";
                        echo "<td>" . $row['Shelf_Number'] . "</td>";
                        echo "<td>" . $row['Number_of_Items_Down'] . "</td>";
                        echo "<td>" . $row['Item_UPC'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                } else {
                    echo "0 items";
                }
            ?>
        </table>
        <a id="expiration"><h1>Expiration</h1></a>
        <?php
            require_once('connect.php');

            $sql = "SELECT * FROM EXPIRATION
            ORDER BY EXPIRATION.Expiration_Date";
            $all_items = $conn->query($sql);
        ?>
    
        <table class="fl-table">
            <!-- <table border = '2' style="display: inline-block; border-collapse: collapse"> -->
            <thead>
                <tr>
                    <th>Item UPC</th>
                    <th>Expiration Date</th>
                </tr>
            </thead>
            <?php
                if ($all_items->num_rows > 0) {
                    // output data of each row
                    echo "<tbody>";
                    while($row = $all_items->fetch_assoc()) {   
                        echo "<tr>";
                        echo "<td>" . $row['Item_UPC'] . "</td>";
                        echo "<td>" . $row['Expiration_Date'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                } else {
                    echo "0 items";
                }
            ?>
        </table>
        <a id="deliveries"><h1>Deliveries</h1></a>
        <?php
            require_once('connect.php');
            $sql = "SELECT * FROM DELIVERY
            ORDER BY DELIVERY.Arrival_Date";
            $all_deliveries = $conn->query($sql);
        ?>
        <table class="fl-table">
            <thead>
                <tr>
                    <th>Delivery ID</th>
                    <th>Arrival</th>
                    <th>Pallet Amount</th>
                    <th>Truck Number</th>
                </tr>
            </thead>
            <?php
                if ($all_deliveries->num_rows > 0) {
                    // output data of each row
                    echo "<tbody>";
                    while($row = $all_deliveries->fetch_assoc()) {   
                        echo "<tr>";
                        echo "<td>" . $row['ID'] . "</td>";
                        echo "<td>" . $row['Arrival_Date'] . "</td>";
                        echo "<td>" . $row['Pallet_Amount'] . "</td>";
                        echo "<td>" . $row['Truck_Number'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                } else {
                    echo "0 Deliveries";
                }
            ?>
        </table>
        <a id="orders"><h1>Orders</h1></a>
        <?php
            require_once('connect.php');

            $sql = "SELECT * FROM `ORDER`
            ORDER BY `ORDER`.Order_Date";
            $all_items = $conn->query($sql);
        ?>
    
        <table class="fl-table">
            <!-- <table border = '2' style="display: inline-block; border-collapse: collapse"> -->
            <thead>
                <tr>
                    <th>Item UPC</th>
                    <th>Amount of Item</th>
                    <th>Order Date</th>
                    <th>Delivery Status</th>
                    <th>Delivery ID</th>
                </tr>
            </thead>
            <?php
                if ($all_items->num_rows > 0) {
                    // output data of each row
                    echo "<tbody>";
                    while($row = $all_items->fetch_assoc()) {   
                        echo "<tr>";
                        echo "<td>" . $row['Item_UPC'] . "</td>";
                        echo "<td>" . $row['Amount_of_Item'] . "</td>";
                        echo "<td>" . $row['Order_Date'] . "</td>";
                        echo "<td>" . $row['Delivery_Status'] . "</td>";
                        echo "<td>" . $row['Delivery_ID'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                } else {
                    echo "0 items";
                }
            ?>
        </table>
        <a id="customers"><h1>Customers</h1></a>
        <?php
            require_once('connect.php');

            $sql = "SELECT * FROM CUSTOMER
            ORDER BY CUSTOMER.Name";
            $all_items = $conn->query($sql);
        ?>
    
        <table class="fl-table">
            <!-- <table border = '2' style="display: inline-block; border-collapse: collapse"> -->
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone Number</th>
                </tr>
            </thead>
            <?php
                if ($all_items->num_rows > 0) {
                    // output data of each row
                    echo "<tbody>";
                    while($row = $all_items->fetch_assoc()) {   
                        echo "<tr>";
                        echo "<td>" . $row['Name'] . "</td>";
                        echo "<td>" . $row['Phone_Number'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                } else {
                    echo "0 items";
                }
            ?>
        </table>
        <a id="transactions"><h1>Transactions</h1></a>
        <?php
            require_once('connect.php');

            $sql = "SELECT * FROM TRANSACTION
            ORDER BY TRANSACTION.Customer_Phone_Number, TRANSACTION.ID";
            $all_items = $conn->query($sql);
        ?>
    
        <table class="fl-table">
            <!-- <table border = '2' style="display: inline-block; border-collapse: collapse"> -->
            <thead>
                <tr>
                    <th>Customer Phone Number</th>
                    <th>Transaction ID</th>
                    <th>Transaction Date</th>
                    <th>Transaction Time</th>
                </tr>
            </thead>
            <?php
                if ($all_items->num_rows > 0) {
                    // output data of each row
                    echo "<tbody>";
                    while($row = $all_items->fetch_assoc()) {   
                        echo "<tr>";
                        echo "<td>" . $row['Customer_Phone_Number'] . "</td>";
                        echo "<td>" . $row['ID'] . "</td>";
                        echo "<td>" . $row['Transaction_Date'] . "</td>";
                        echo "<td>" . $row['Transaction_Time'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                } else {
                    echo "0 items";
                }
            ?>
        </table>
        <a id="purchases"><h1>Purchases</h1></a>
        <?php
            require_once('connect.php');

            $sql = "SELECT * FROM PURCHASE
            ORDER BY PURCHASE.Customer_Phone_Number, PURCHASE.Transaction_ID";
            $all_items = $conn->query($sql);
        ?>
    
        <table class="fl-table">
            <!-- <table border = '2' style="display: inline-block; border-collapse: collapse"> -->
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>Customer Phone Number</th>
                    <th>Item UPC</th>
                    <th>Number Bought</th>
                    <th>Price Paid</th>
                </tr>
            </thead>
            <?php
                if ($all_items->num_rows > 0) {
                    // output data of each row
                    echo "<tbody>";
                    while($row = $all_items->fetch_assoc()) {   
                        echo "<tr>";
                        echo "<td>" . $row['Transaction_ID'] . "</td>";
                        echo "<td>" . $row['Customer_Phone_Number'] . "</td>";
                        echo "<td>" . $row['Item_UPC'] . "</td>";
                        echo "<td>" . $row['Number_Bought'] . "</td>";
                        echo "<td>" . $row['Price_Paid'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                } else {
                    echo "0 items";
                }
            ?>
        </table>
        <a id="coupons"> <h1>Coupons</h1> </a>
        <?php
            require_once('connect.php');

            $sql = "SELECT * FROM COUPON
            ORDER BY COUPON.Item_UPC";
            $all_items = $conn->query($sql);
        ?>
    
        <table class="fl-table">
            <!-- <table border = '2' style="display: inline-block; border-collapse: collapse"> -->
            <thead>
                <tr>
                    <th>Coupon ID</th>
                    <th>Discount Amount</th>
                    <th>Item UPC</th>
                    <th>Required Item Amount</th>  
                </tr>
            </thead>
            <?php
                if ($all_items->num_rows > 0) {
                    // output data of each row
                    echo "<tbody>";
                    while($row = $all_items->fetch_assoc()) {   
                        echo "<tr>";
                        echo "<td>" . $row['ID'] . "</td>";
                        echo "<td>" . $row['Discount_Amount'] . "</td>";
                        echo "<td>" . $row['Item_UPC'] . "</td>";
                        echo "<td>" . $row['Required_Item_Amount'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                } else {
                    echo "0 items";
                }
            ?>
        </table>
        <a id="bought"> <h1>Bought</h1> </a>
        <?php
            require_once('connect.php');

            $sql = "SELECT * FROM BOUGHT
            ORDER BY BOUGHT.Customer_Phone_Number";
            $all_items = $conn->query($sql);
        ?>
    
        <table class="fl-table">
            <!-- <table border = '2' style="display: inline-block; border-collapse: collapse"> -->
            <thead>
                <tr>
                    <th>Item UPC</th>
                    <th>Customer Phone Number</th>
                </tr>
            </thead>
            <?php
                if ($all_items->num_rows > 0) {
                    // output data of each row
                    echo "<tbody>";
                    while($row = $all_items->fetch_assoc()) {   
                        echo "<tr>";
                        echo "<td>" . $row['Item_UPC'] . "</td>";
                        echo "<td>" . $row['Customer_Phone_Number'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                } else {
                    echo "0 items";
                }
            ?>
        </table>
        <a id="downloads"> <h1>Downloads</h1> </a>
        <?php
            require_once('connect.php');

            $sql = "SELECT * FROM DOWNLOADS
            ORDER BY DOWNLOADS.Customer_Phone_Number";
            $all_items = $conn->query($sql);
        ?>
    
        <table class="fl-table">
            <!-- <table border = '2' style="display: inline-block; border-collapse: collapse"> -->
            <thead>
                <tr>
                    <th>Coupon ID</th>
                    <th>Customer Phone Number</th>
                </tr>
            </thead>
            <?php
                if ($all_items->num_rows > 0) {
                    // output data of each row
                    echo "<tbody>";
                    while($row = $all_items->fetch_assoc()) {   
                        echo "<tr>";
                        echo "<td>" . $row['Coupon_ID'] . "</td>";
                        echo "<td>" . $row['Customer_Phone_Number'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                } else {
                    echo "0 items";
                }
            ?>
        </table>

    </div>

</html>
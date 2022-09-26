<!DOCTYPE html>
<html>
<meta charset="utf-8">
<link rel="stylesheet"
     href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.min.css">
     <p><a href="http://ecs.fullerton.edu/~cs332u30">Return to Homepage</a></p>
</html>
<!--========================================================================-->
<?php
/*Add new item to inventory (10 points)
Add a new inventory item to the and all its necessary information to the database*/

// Retrieve values from "add_Items_Form.html"
$upc =  $_POST['upc'];
$salePrice = $_POST['salePrice'];
$price =  $_POST['price'];
$wholeSalePrice = $_POST['wholeSalePrice'];
$currentStock = $_POST['currentStock'];
$restockAmt = $_POST['restockAmt'];
$tID = "531"; // New default value

// Check values in the array. (values obtained)
// var_dump($upc, $salePrice, $price, $wholeSalePrice, $currentStock, $restockAmt);

// Create connection
// servername => localhost
// username => root
// password => empty
// database name => staff
$dbhost = "mariadb";
$dbuser = "cs332u30";
$dbpass = "N0BpkQoc";
$dbname = "cs332u30";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);// idk how to do this

// ======================= Check connection ================================================
if($conn === false)
        {//The die() function prints a message and exits the current script
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
        else
            {
        		    echo "<br><br>Connection Sucessful!<br><br>";
            }
// ============================================= Insert Query ===========================================
$sql = "INSERT INTO Items VALUES (" . $upc . "," . $salePrice . ",". $price ."," . $wholeSalePrice . "," . $currentStock . "," . $restockAmt . "," . $tID .")";

//$sql = "INSERT INTO Items (upc, salePrice, price, wholeSalePrice, currentStock, restockAmt, tID)
//VALUES ("123456789010", 21.00, 15.00, 10.00, 50,30, "531")";

if(mysqli_query($conn, $sql))
        {
            echo "<h4>data stored in a database successfully."
                . " go to mariadb "
                . " to view the updated data</h4>";

            echo nl2br("\nUPC: $upc\n Sale Price: $salePrice\n "
                . "Price: $price\n Wholesale Price: $wholeSalePrice\n Restock Amount: $restockAmt"
                . "<br> Transaction ID: $tID\n");
        }
else
        {
            echo "Error, unable to insert data! $sql. " . mysqli_error($conn);
        }

        // Close connection
        mysqli_close($conn);

?>

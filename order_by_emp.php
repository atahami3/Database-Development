<html>
<meta charset="utf-8">
<link rel="stylesheet"
     href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.min.css">
     <p><a href="http://ecs.fullerton.edu/~cs332u30">Return to Homepage</a></p>
</html>
<!--========================================================================-->
<?php

/* ===================== Prompt ========================
Place order by an employee (25 points)
Should take an employee id, item id, and amount of the item to order
If the employee’s permission level is 0 return a message saying they do not have permission and reject the order
If the employee does have permission then add the order to the database with the order not having been added to a delivery yet
========================================================*/

$dbhost = "mariadb";
$dbuser = "cs332u30";
$dbpass = "N0BpkQoc";
$dbname = "cs332u30";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

$idNum =  $_POST['idNum'];
$upc =  $_POST['upc'];
$amount =  $_POST['amount'];
$pLevel;
$randNum;
$delivery = 0;
$date = date("Y-m-d");

// Check Variables
// var_dump($idNum, $upc, $amount);

// ============================ Check connection ==================================
if (!$conn)
      {
  		  die("Connection failed! " . mysqli_connect_error());
      }

else
    {
		    echo "<br><br>Connection Sucessful!<br><br>";


        $sql = "SELECT Employees.permissionLVL
                FROM Employees
                Where idNum = \"" .$idNum. "\";";

        $result = mysqli_query($conn, $sql);

        $row = mysqli_fetch_row($result);
        $pLevel = $row[0];
//var_dump($pLevel);
// ======= Test Query ===========
//echo "<br><br> $sql";
// ==============================
  }
// ================================================= Query =================================================
if($pLevel == 1)
    {
      $sqlRand = "SELECT FLOOR(RAND() * 999) AS randNum
                  FROM Orders
                  WHERE \"randNum\" NOT IN (SELECT orderID FROM Orders)
                  LIMIT 1;";

// ======= Test Query ===========
//echo "<br><br>$sqlRand";
// ==============================
      $result2 = mysqli_query($conn, $sqlRand);
      $row2 = mysqli_fetch_row($result2);
      $randNum = $row2[0];

      $sql2 = "INSERT INTO Orders VALUES(".$randNum." , ".$delivery." , ".$amount." ,'". $date ."');";

      $sql3 = "INSERT INTO forOrder VALUES(\"".$upc."\",".$randNum.");";


      mysqli_query($conn, $sql2);
      mysqli_query($conn, $sql3);

      // ======= Test $sql2 ===========
      //echo "<br><br>$sql2";
      // ==============================
      // ======= Test $sql3 ===========
      //echo "<br><br>$sql3";
      // ==============================

      echo "Success! Your OrderID = $randNum has been added to the database!";
      echo "<br>";
      //
    }
else
    {
      echo "You do not have permission to place an order";
      echo "<br>";
    }

/* ====================================== OUTPUT =====================================
Return to Homepage

string(6) "881188" string(12) "000000000002" string(2) "20"

Connection Sucessful!

string(1) "1"

SELECT FLOOR(RAND() * 999) AS randNum FROM Orders WHERE "randNum" NOT IN (SELECT orderID FROM Orders) LIMIT 1;

INSERT INTO Orders VALUES(739 , 0 , 20 ,'2022-05-07');

INSERT INTO forOrder VALUES("000000000002",739);Success! Your OrderID = 739 has been added to the database!

IN SQL:
select * from Orders;
+---------+-----------------+--------+------------+
| orderID | addedToDelivery | amount | orderDate  |
+---------+-----------------+--------+------------+
|     739 |               0 |     20 | 2022-05-07 |
|     808 |               0 |     20 | 2021-11-11 |
|     809 |               1 |     15 | 2021-01-10 |
|     953 |               0 |     20 | 2022-05-07 |
+---------+-----------------+--------+------------+
4 rows in set (0.00 sec)
====================================== END OUTPUT ===================================== */
?>

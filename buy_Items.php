<!DOCTYPE html>
<html>
<head>
    <title>Buy Items</title>
    <meta charset="utf-8">
    <link rel="stylesheet"
         href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.min.css">
         <p><a href="http://ecs.fullerton.edu/~cs332u30">Return to Homepage</a></p>
</head>

</body>
</html>
<!--================================================================================================-->
<?php

/*Buy item (30 points)
  Should take an item id, customer id, and transaction id and add the item to the transaction.
  If no transaction id is given then a new transaction is started for the customer.
  After a transaction is started the transaction id should be printed out so that the transaction can be continued.*/


  $dbhost = "mariadb";
  $dbuser = "cs332u30";
  $dbpass = "N0BpkQoc";
  $dbname = "cs332u30";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

$upc =  $_POST['upc'];
$cuID =  $_POST['cuID'];
$tID =  $_POST['tID'];

$tDate = date("Y-m-d");
$tTime = date("H:i:s");

$purchasedItems = 2;
$numberOfItems = 2;

//var_dump($upc, $cuID, $tID);

// ======================= Check connection ================================================
if (!$conn)
  {
  		die("Connection failed: " . mysqli_connect_error());
	}
else
  {
		  echo "<br><br>Connection Sucessful! <br><br>";
  }
// ================================================= Query =================================================
if($tID == '')
      {
        $sqlRand = "SELECT FLOOR(RAND() * 999) AS randNum
                    FROM Transactions
                    WHERE \"randNum\" NOT IN (SELECT tID FROM Transactions)
                    LIMIT 1";
// Check query variable
//var_dump($sqlRand);

          $randResult = mysqli_query($conn, $sqlRand);
          $row2 = mysqli_fetch_row($randResult);
          $randResult = $row2[0];

          $sql0 = "INSERT INTO Transactions VALUES( \"". $randResult ."\" , '". $tDate . "' , '". $tTime . "', \"" . $cuID ."\");";
// ======= Test Query ===========
 //echo "<br><br>$sql0";
// ==============================
          $sql1 = "INSERT INTO TransactWith VALUES(\"".$randResult."\" , \"".$upc."\" , \"". $purchasedItems . "\", \"". $numberOfItems ."\" , \"". $cuID . "\");";
// ======= Test Query ===========
 //echo "<br><br>$sql1";
// ==============================

          $resultQ1 = mysqli_query($conn, $sql0);
          $resultQ2 = mysqli_query($conn, $sql1);

          echo "<br><br>New Generated Transaction ID is, $randResult ";



//var_dump($sqlRand, $sql0, $sql1, $result);

      }

else
      {

        $sql2 = "INSERT INTO Transactions VALUES( \"".$tID."\" , '". $tDate . "' , '". $tTime . "', \"" . $cuID ."\");";
        $sql3 = "INSERT INTO TransactWith VALUES(\"".$tID."\" , \"".$upc."\" , \"". $purchasedItems . "\", \"". $numberOfItems ."\" , \"". $cuID . "\");";
// ======= Test Query ===========
//echo "<br><br>$sql2";
// ==============================

        $resultQ3 = mysqli_query($conn, $sql2);
        $resultQ4 = mysqli_query($conn, $sql3);

//var_dump($resultQ3);
if($resultQ3 && $resultQ4  == 'True')
        {
          echo "Query Successfully Inserted!";
          //echo "Query Successfully Inserted! <br><br> Query:  $sql2 <br>";
          //echo "Query Successfully Inserted! <br><br> Query:  $sql3 ";
        }
else{ echo "Ooopsy, unable to insert.. ";}
      }
/* ============================= OUTPUT ===========================================

==================== $sql2: ================
Return to Homepage



Connection Sucessful!

Query Successfully Inserted!

Query: INSERT INTO TransactWith VALUES("531" , "000000000000" , "2", "2" , "11111");
=================== resultQ3 ===================
Connection Sucessful!

Ooopsy, unable to insert..
================================================================================== */
?>

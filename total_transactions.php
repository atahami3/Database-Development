<!DOCTYPE html>
<html>
<meta charset="utf-8">
<link rel="stylesheet"
     href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.min.css">
     <p><a href="http://ecs.fullerton.edu/~cs332u30">Return to Homepage</a></p>
</html>
<!--========================================================================-->

<?php
/*
Total transaction (25 points)
Takes a transaction and a customer id
Should calculate the total for the transaction given
Returns 0 if the transaction does not exist

*/
// Getting values from the $_POST array in "total_Trans_form.html"
$tID =  $_POST['tID'];
$cuID =  $_POST['cuID'];

// Check values in the array. (values obtained)
//var_dump($tID, $cuID);
$dbhost = "mariadb";
$dbuser = "cs332u30";
$dbpass = "N0BpkQoc";
$dbname = "cs332u30";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
// Check connection
if (!$conn)
    {
  		  die("Connection failed: " . mysqli_connect_error());
	  }

else
    {
		    echo "Connection Sucessful!<br><br>";

// Performing insert query execution
        $sql = "SELECT SUM(Items.Price), SUM(TransactWith.perchasedItems), (SUM(Items.Price) * SUM(TransactWith.perchasedItems)) AS totalPrice
                FROM Items, TransactWith, Transactions
                WHERE Items.upc=TransactWith.upc AND TransactWith.tID=Transactions.tID AND TransactWith.cuID=Transactions.cuID AND Transactions.tID = ". $tID ." AND Transactions.cuID = ". $cuID ."";


        $sql2 ="SELECT * FROM Transactions Where Transactions.tID =  ". $tID ." AND Transactions.cuID =  ". $cuID ." ;";
        //$sql2 ="SELECT * FROM TransactWith Where TransactWith.tID =  ". $tID .";";

        $result2 = mysqli_query($conn, $sql2);
    		$result = mysqli_query($conn, $sql);

      //if(mysqli_num_rows())
		if (mysqli_num_rows($result2) > 0)
        {
  			    // output data of each row
 	         while($row = mysqli_fetch_assoc($result)) {//result gets printed here
    			       echo  "Transaction Total = " . "\n<tr>" .
			                  "\n\t<td>"."$" . $row["totalPrice"] . "</td>" .
					              "\n</tr>";
  			}
		      echo "\n</table>";
          //if($row["SUM(Items.Price)"]==NULL){echo "0";}
	}
  else
      {
        echo "$0: Transaction ID does not exist";
      }
		//if($row["SUM(Items.Price)"] == NULL){echo "0";}
		}
?>

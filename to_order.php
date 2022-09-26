<!DOCTYPE html>
<html>
<meta charset="utf-8">
<link rel="stylesheet"
     href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.min.css">
     <p><a href="http://ecs.fullerton.edu/~cs332u30">Return to Homepage</a></p>
</html>
<!--========================================================================-->

<?php
//Should take a department number
//Should print a list of items that are associated with that department, that the stock is less than or equal to the restock amount

$dbhost = "mariadb";
$dbuser = "cs332u30";
$dbpass = "N0BpkQoc";
$dbname = "cs332u30";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);// idk how to do this

$dName =  $_POST['dName'];

// ============================ Check connection ==================================
if (!$conn)
      {
      		die("Connection failed: " . mysqli_connect_error());
    	}
else
      {
    		echo "<br>Connection Sucessful!<br><br>";

// =================================================== Performing insert query ============================================================
    $sql = "SELECT forOrder.upc, forOrder.oID
            FROM forOrder
            WHERE forOrder.upc IN (SELECT upc
                                   FROM Items
                                   WHERE currentStock < restockAmt AND Items.upc IN (SELECT DISTINCT inDpt.upc
                                                                                     FROM inDpt
                                                                                     WHERE inDpt.name = \"" . $dName .  "\"))";
// ========================================================= END query ===================================================================
//"Rings" is a placehold for testing, in reality we would be wanting to use php script to get the user input in there


        $result = mysqli_query($conn, $sql);
            //echo "$dName <br>";
        if (mysqli_num_rows($result) > 0)
              {
          			// output data of each row
        //if ($sql experationDate == Date() +2)//work on this?
         			    while($row = mysqli_fetch_assoc($result))
                          {
                    				echo    "\n<tr>" .
                				          "\n\t<td> UPC: " . $row["upc"] . "</td>" .
                                  "\n\t<td> <br> Order ID: " . $row["oID"] . "</td> <br><br>" .
                					          "\n</tr>";
          		            }

              echo "\n</table>";
        		}

        		else {echo "0 results";}
	   }
?>

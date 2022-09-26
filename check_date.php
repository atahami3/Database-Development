<!DOCTYPE html>
<html>

<head>
    <title>Check Item Expiration Date</title>
    <meta charset="utf-8">
    <link rel="stylesheet"
         href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.min.css">
         <p><a href="http://ecs.fullerton.edu/~cs332u30">Return to Homepage</a></p>
</head>
    <!--========================================================================-->
<?PHP
/*Create list of items to check for past date ( 20 points)
Should take a department number
Should return a list of items associated with that department that are to expire within the next 2 days(today’s date +2)*/

$dbhost = "mariadb";
$dbuser = "cs332u30";
$dbpass = "N0BpkQoc";
$dbname = "cs332u30";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);// idk how to do this

$dName =  $_POST['dName'];

// Performing insert query execution

// Check connection
if (!$conn) {
  		die("Connection failed! " . mysqli_connect_error());
	}
	else {
		echo "<br>Connection Sucessful!<br>";

    $sql = "SELECT DISTINCT expirationDate, upc
            From ExpirationDate
            Where ExpirationDate.upc IN (SELECT inDpt.upc
                                         FROM inDpt, Department
                                         WHERE \"" .$dName.  "\"= inDpt.name) AND expirationDate < curdate() + 2";

//echo $sql;
    /*$sql = "SELECT experationDate, upc
            From ExpirationDate
            Where ExpirationDate.upc = (SELECT inDpt.upc
                                         FROM inDpt, Department
                                         WHERE Department.dname = inDpt.name)";*/


		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
  			// output data of each row
 			 while($row = mysqli_fetch_assoc($result)) {//result gets printed here
    				echo    "\n<tr>" .
				          "\n\t<td>". " <br><br>UPC: " . $row["upc"] . "</td>" .
                  "\n\t<td>" . " <br>EXP Date: " . $row["expirationDate"] . "</td>" .
					          "\n</tr>";
  			}
			echo "\n</table>";
		}
		else {
  			echo "0 results";
		}
	}
?>

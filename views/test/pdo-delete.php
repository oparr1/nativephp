<!DOCTYPE html>
<html>
<body>

<?php
// Use require_once for DB
require_once('config/database.php');
// Call the Function
$conn = pdoConnected();
$conn->exec("set names utf8");

$ID = 3;

$statement = $conn->prepare("SELECT firstName, lastName, addressOne, addressTwo, city, region, postCode, phoneNumber 
                             FROM Address 
                             WHERE ID = ?");
$statement->bindValue(1, $ID);
$statement->execute();

$row = $statement->fetch(PDO::FETCH_ASSOC);

// Define Variables outside of the loop
$firstName = $row['firstName'];
$lastName = $row['lastName'];
$addressOne = $row['addressOne'];
$addressTwo = $row['addressTwo'];
$city = $row['city'];
$region = $row['region'];
$postCode = $row['postCode'];
$phoneNumber = $row['phoneNumber'];

$errors = array();

// Escape output safely - only use on echo / OUTPUT
function html($data) {
	$data = htmlspecialchars($data, ENT_QUOTES); // <>

    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	// Update the Address table 'TABLE NAME', SET'column names', ? 'numbered bindValue'
	$statement = $conn->prepare("DELETE FROM Address WHERE ID = ? ");
	$statement->bindValue(1, $ID); // ID = ?
	$ID = 3;
	$statement->execute();

	// Check if result exists basically
	if ($statement->rowCount() > 0 ) 
	{
		echo "Record deleted successfully";
	}
}

$conn = null;

?>

<ul>
<?php 

echo "<li>".html($firstName)."</li>";
echo "<li>".html($lastName)."</li>";
echo "<li>".html($addressOne)."</li>";
echo "<li>".html($addressTwo)."</li>";
echo "<li>".html($city)."</li>";
echo "<li>".html($region)."</li>";
echo "<li>".html($postCode)."</li>";
echo "<li>".html($phoneNumber)."</li>";

?>
</ul>

<form id="form" action="pdo-delete" method="post" novalidate>
	<div class="form-group">
	    <div class="col-md-offset-2 col-md-10">
	        <button type="submit" value="Create" class="btn btn-default">Delete</button>
	    </div>
	</div>
</form>


</body>
</html> 
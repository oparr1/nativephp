<!DOCTYPE html>
<html>
<body>

<?php
// Use require_once for DB
require_once('config/database.php');
// Call the Function
$conn = mysqliConnected();

// mysqli Query
$statement = $conn->prepare("SELECT firstName, lastName, addressOne, addressTwo, city, region, postCode, phoneNumber 
                             FROM Address 
                             WHERE ID = ?");
$statement->bind_param('i', $ID);
$ID = 3;
$statement->execute();

$result = $statement->get_result();

// Escape output safely - only use on echo / OUTPUT
function html($data) {
	$data = htmlspecialchars($data, ENT_QUOTES); // <>

    return $data;
}

// On Submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {

		// Deleting the record	
		if($statement = $conn->prepare("DELETE FROM Address WHERE ID = ?"))	
		{ 
			$statement->bind_param('i', $ID);
			$ID = 3;
			$statement->execute();
			$result = $statement->get_result();
			
			// Check if result exists basically
			if ($result->num_rows > 0) 
			{
			echo "Record deleted successfully";
			}
		}
}

?>

<!-- View -->

<ul>
<?php 

// Display Query Results
if ($result->num_rows > 0) {

	// Using Objects instead of assoc
	while($row = $result->fetch_object()){
	    echo "<li>".html($row->firstName)."</li>";
		echo "<li>".html($row->lastName)."</li>";
		echo "<li>".html($row->addressOne)."</li>";
		echo "<li>".html($row->addressTwo)."</li>";
		echo "<li>".html($row->city)."</li>";
		echo "<li>".html($row->region)."</li>";
		echo "<li>".html($row->postCode)."</li>";
		echo "<li>".html($row->phoneNumber)."</li>";
	}
		$result->free();
}
else {
	echo "No results found";
}

$conn->close();

?>
</ul>

<form id="form" action="mysqli-delete" method="post" novalidate>
	<div class="form-group">
	    <div class="col-md-offset-2 col-md-10">
	        <button type="submit" value="Create" class="btn btn-default">Delete</button>
	    </div>
	</div>
</form>


</body>
</html> 
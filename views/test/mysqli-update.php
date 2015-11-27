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
$row = $result->fetch_assoc();

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

	// Clean input before insert and isset/empty data to prevent undefined index
	function clean_input($data, $default = NULL) {
		// trim(); // no whitespaces
		// stripslashes(); // strip slashes \\\\
		// strip_tags(); // <p></p> only if you dont want html tags
		// mysqli_real_escape_string(); // when using sqli not prepared statement

		// return isset, not empty and sanitized POST
	    return isset($_POST[$data]) ? stripslashes(trim($_POST[$data])) : $default;
	}

	$firstName = clean_input('firstName'); // isset($_POST['firstName']) && !empty($_POST['firstName]) ? $_POST['firstName']) : "";
	$lastName = clean_input('lastName');
	$addressOne = clean_input('addressOne');  
	$addressTwo = clean_input('addressTwo');
	$city = clean_input('city'); 
	$region = clean_input('region');
	$postCode = clean_input('postCode'); 
	$phoneNumber = clean_input('phoneNumber'); 

	// Error Validation Here

	if (empty($errors)) {
		// Update the Address table 'TABLE NAME', SET'column names', ? 'numbered bindValue'
		$statement = $conn->prepare("UPDATE Address SET firstName = ?, lastName = ?, addressOne = ?, addressTwo = ?, city = ?, region = ?, postCode = ?, phoneNumber = ? WHERE ID = ?");
		// s - string, i = integer, d - double, b - blob
		$statement->bind_param('ssssssssi', $firstName, $lastName, $addressOne, $addressTwo, $city, $region, $postCode, $phoneNumber, $ID);
		$ID = 3;
		$statement->execute();
	    echo "Record updated successfully";
	}		
}

mysqli_close($conn);

?>

<form id="form" action="mysqli-update" method="post" novalidate>
	 <div class="form-group">
		<label class="required">First Name</label>
		<input class="form-control" type="text" name="firstName" placeholder="First Name" value="<?php echo html($firstName); ?>">
	</div>
	 <div class="form-group">
		<label class="required">Last Name</label>
		<input class="form-control" type="text" name="lastName" placeholder="Last Name" value="<?php echo html($lastName); ?>">
	</div>
	<div class="form-group">
	    <label class="required">Address Line 1</label>
	    <input class="form-control" type="text" name="addressOne" placeholder="Address Line 1" value="<?php echo html($addressOne); ?>">
	</div>
	<div class="form-group">
	    <label class="required">Address Line 2</label>
	    <input class="form-control" type="text" name="addressTwo" placeholder="Address Line 2" value="<?php echo html($addressTwo); ?>">
	</div>
	<div class="form-group">
	    <label class="required">City</label>
	    <input class="form-control" type="text" name="city" placeholder="City" value="<?php echo html($city); ?>">
	</div>
	<div class="form-group">
	    <label class="required">Region</label>
	    <input class="form-control" type="text" name="region" placeholder="Region" value="<?php echo html($region); ?>">
	</div>
	<div class="form-group">
	    <label class="required">Post Code</label>
	    <input class="form-control" type="text" name="postCode" placeholder="Post Code" value="<?php echo html($postCode); ?>">
	</div>
	<div class="form-group">
	    <label class="required">Phone Number</label>
	    <input class="form-control" type="text" name="phoneNumber" placeholder="Phone Number" value="<?php echo html($phoneNumber); ?>">
	</div>
	<div class="form-group">
	    <div class="col-md-offset-2 col-md-10">
	        <button type="submit" value="Create" class="btn btn-default">Submit</button>
	    </div>
	</div>
</form>


</body>
</html> 
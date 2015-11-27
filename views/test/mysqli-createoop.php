<!DOCTYPE html>
<html>
<body>

<?php
// Use require_once for DB
require_once('config/databaseoop.php');

// Initialise database class
// $db = new Database();
$db = Database::getInstance();

// Define Variables outside of the loop
$firstName = $lastName = $addressOne = $addressTwo = $city = "";
$region = $postCode = $phoneNumber = "";

$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$firstName = $db->clean_input('firstName'); // isset($_POST['firstName']) && !empty($_POST['firstName]) ? $_POST['firstName']) : "";
	$lastName = $db->clean_input('lastName');
	$addressOne = $db->clean_input('addressOne');  
	$addressTwo = $db->clean_input('addressTwo');
	$city = $db->clean_input('city'); 
	$region = $db->clean_input('region');
	$postCode = $db->clean_input('postCode'); 
	$phoneNumber = $db->clean_input('phoneNumber'); 

	// Error Validation Here

if (empty($errors)) {
	// Create the Address table 'TABLE NAME', INSERT INTO 'column names', VALUES 'VARIABLE NAMES'
	if ($statement = $db->getConnected()->prepare("INSERT INTO Address (firstName, lastName, addressOne, addressTwo, city, region, postCode, phoneNumber) 
	VALUES (?, ?, ?, ?, ?, ?, ?, ?)")) 
	{
		// s - string, i = integer, d - double, b - blob
		$statement->bind_param('ssssssss', $firstName, $lastName, $addressOne, $addressTwo, $city, $region, $postCode, $phoneNumber);
		$statement->execute();
		// printf("Error: %s\n", $conn->sqlstate); // Test to see if escape worked (Ed O'Neil) - !conn-query();
		echo "Record successfully created";
	}
}
}

?>



<form id="form" action="mysqli-createoop" method="post" novalidate>
	 <div class="form-group">
		<label class="required">First Name</label>
		<input class="form-control" type="text" name="firstName" placeholder="First Name" value="<?php echo $db->html($firstName); ?>">
	</div>
	 <div class="form-group">
		<label class="required">Last Name</label>
		<input class="form-control" type="text" name="lastName" placeholder="Last Name" value="<?php echo $db->html($lastName); ?>">
	</div>
	<div class="form-group">
	    <label class="required">Address Line 1</label>
	    <input class="form-control" type="text" name="addressOne" placeholder="Address Line 1" value="<?php echo $db->html($addressOne); ?>">
	</div>
	<div class="form-group">
	    <label class="required">Address Line 2</label>
	    <input class="form-control" type="text" name="addressTwo" placeholder="Address Line 2" value="<?php echo $db->html($addressTwo); ?>">
	</div>
	<div class="form-group">
	    <label class="required">City</label>
	    <input class="form-control" type="text" name="city" placeholder="City" value="<?php echo $db->html($city); ?>">
	</div>
	<div class="form-group">
	    <label class="required">Region</label>
	    <input class="form-control" type="text" name="region" placeholder="Region" value="<?php echo $db->html($region); ?>">
	</div>
	<div class="form-group">
	    <label class="required">Post Code</label>
	    <input class="form-control" type="text" name="postCode" placeholder="Post Code" value="<?php echo $db->html($postCode); ?>">
	</div>
	<div class="form-group">
	    <label class="required">Phone Number</label>
	    <input class="form-control" type="text" name="phoneNumber" placeholder="Phone Number" value="<?php echo $db->html($phoneNumber); ?>">
	</div>
	<div class="form-group">
	    <div class="col-md-offset-2 col-md-10">
	        <button type="submit" value="Create" class="btn btn-default">Submit</button>
	    </div>
	</div>
</form>


</body>
</html> 